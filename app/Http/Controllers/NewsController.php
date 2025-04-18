<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\StudentOrganization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $isStudentOrganization = auth()->user()->student_organization;
        $newses = News::with('student_organization')
            ->when($isStudentOrganization, function ($query) use ($isStudentOrganization) {
                $query->where('student_organizations_id', $isStudentOrganization->id);
            })
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('description', 'LIKE', '%' . $search . '%')
                        ->orWhereHas('student_organization', function ($q) use ($search) {
                            $q->where('name', 'LIKE', '%' . $search . '%')
                                ->orWhere('abbreviation', 'LIKE', '%' . $search . '%');
                        });
                });
            })
            ->latest()
            ->paginate(10);

        return view('dashboard.news.index', [
            'page' => 'Halaman Berita',
            'newses' => $newses,
            'search' => $search,
        ]);
    }

    public function show(News $news)
    {
        $news->load('student_organization');

        return view('dashboard.news.detail', [
            'page' => 'Halaman Detail Berita',
            'news' => $news,
        ]);
    }

    public function create()
    {
        $studentOrganizations = StudentOrganization::latest()->get();

        return view('dashboard.news.create', [
            'page' => 'Halaman Tambah Berita',
            'studentOrganizations' => $studentOrganizations,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'image_path' => 'required|file|image|mimes:png,jpg,jpeg,gif,webp,svg|max:2048',
                'student_organizations_id' => 'required',
                'name' => 'required|string|max:150',
                'description' => 'required|string',
            ]);

            if ($request->hasFile('image_path')) {
                $imageFile = $request->file('image_path');
                $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path('assets/image/news'), $imageName);
                $validatedData['image_path'] = $imageName;
            }

            News::create($validatedData);

            return redirect()->route('news.index')->with('success', 'Berhasil menambahkan berita baru!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menambahkan berita baru!');
        }
    }

    public function edit(News $news)
    {
        $news->load('student_organization');
        $studentOrganizations = StudentOrganization::latest()->get();

        return view('dashboard.news.edit', [
            'page' => 'Halaman Edit Berita',
            'news' => $news,
            'studentOrganizations' => $studentOrganizations,
        ]);
    }

    public function update(Request $request, News $news)
    {
        try {
            $validatedData = $request->validate([
                'image_path' => 'nullable|file|image|mimes:png,jpg,jpeg,gif,webp,svg|max:2048',
                'student_organizations_id' => 'required',
                'name' => 'required|string|max:150',
                'description' => 'required|string',
            ]);

            if ($request->hasFile('image_path')) {
                $imageFile = $request->file('image_path');
                $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
                if ($news->image_path && File::exists(public_path('assets/image/news/' . $news->image_path))) {
                    File::delete(public_path('assets/image/news/' . $news->image_path));
                }
                $imageFile->move(public_path('assets/image/news'), $imageName);
                $validatedData['image_path'] = $imageName;
            } else {
                $validatedData['image_path'] = $news->image_path;
            }

            $news->update($validatedData);
            return redirect()->route('news.index')->with('success', 'Berhasil mengedit berita!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal mengedit berita!');
        }
    }

    public function destroy(News $news)
    {
        try {
            if ($news->image_path && File::exists(public_path('assets/image/news/' . $news->image_path))) {
                File::delete(public_path('assets/image/news/' . $news->image_path));
            }
            $news->delete();
            return redirect()->route('news.index')->with('success', 'Berhasil menghapus berita!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menghapus berita!');
        }
    }
}
