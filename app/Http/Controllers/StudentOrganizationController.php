<?php

namespace App\Http\Controllers;

use App\Models\StudentOrganization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class StudentOrganizationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $studentOrganizations = StudentOrganization::with(['student_organization_programs', 'student_organization_achievements'])
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('abbreviation', 'LIKE', '%' . $search . '%')
                    ->orWhere('description', 'LIKE', '%' . $search . '%');
            })->latest()->paginate(10);

        return view('dashboard.student-organization.index', [
            'page' => 'Halaman Organisasi Mahasiswa',
            'studentOrganizations' => $studentOrganizations,
            'search' => $search,
        ]);
    }

    public function show(StudentOrganization $studentOrganization)
    {
        $studentOrganization->load(['user', 'student_organization_visions', 'student_organization_missions', 'student_organization_programs', 'student_organization_structures', 'student_organization_achievements', 'newses', 'events']);

        return view('dashboard.student-organization.detail', [
            'page' => 'Halaman Detail Organisasi Mahasiswa',
            'studentOrganization' => $studentOrganization,
        ]);
    }

    public function create()
    {
        return view('dashboard.student-organization.create', [
            'page' => 'Halaman Tambah Organisasi Mahasiswa',
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validatedDataStudentOrganization = $request->validate([
                'image_path' => 'required|file|image|mimes:png,jpg,jpeg,gif,webp,svg|max:2048',
                'name' => 'required|string|max:100',
                'abbreviation' => 'required|max:50',
                'description' => 'required|string',
            ]);

            $validatedDataUser = $request->validate([
                'username' => 'required|string|max:100',
                'email' => 'required|string|max:255',
                'password' => 'required|string',
            ]);

            if ($request->hasFile('image_path')) {
                $imageFile = $request->file('image_path');
                $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path('assets/image/student-organization'), $imageName);
                $validatedDataStudentOrganization['image_path'] = $imageName;
            }

            $validatedDataUser['password'] = Hash::make($validatedDataUser['password']);
            $studentOrganization = StudentOrganization::create($validatedDataStudentOrganization);
            $validatedDataUser['student_organizations_id'] = $studentOrganization->id;
            User::create($validatedDataUser);

            return redirect()->route('student-organization.index')->with('success', 'Berhasil menambahkan ormawa baru!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menambahkan ormawa baru!');
        }
    }

    public function edit(StudentOrganization $studentOrganization)
    {
        $studentOrganization->load('user');

        return view('dashboard.student-organization.edit', [
            'page' => 'Halaman Edit Organisasi Mahasiswa',
            'studentOrganization' => $studentOrganization,
        ]);
    }

    public function update(Request $request, StudentOrganization $studentOrganization)
    {
        try {
            $studentOrganization->load('user');
            $validatedDataStudentOrganization = $request->validate([
                'image_path' => 'nullable|file|image|mimes:png,jpg,jpeg,gif,webp,svg|max:2048',
                'name' => 'required|string|max:100',
                'abbreviation' => 'required|max:50',
                'description' => 'required|string',
            ]);

            $validatedDataUser = $request->validate([
                'username' => 'required|string|max:100',
                'email' => 'required|string|max:255',
                'password' => 'nullable|string',
            ]);

            if ($request->hasFile('image_path')) {
                $imageFile = $request->file('image_path');
                $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
                if ($studentOrganization->image_path && File::exists(public_path('assets/image/student-organization/' . $studentOrganization->image_path))) {
                    File::delete(public_path('assets/image/student-organization/' . $studentOrganization->image_path));
                }
                $imageFile->move(public_path('assets/image/student-organization'), $imageName);
                $validatedDataStudentOrganization['image_path'] = $imageName;
            } else {
                $validatedDataStudentOrganization['image_path'] = $studentOrganization->image_path;
            }

            if (!empty($validatedDataUser['password'])) {
                $validatedDataUser['password'] = Hash::make($validatedDataUser['password']);
            } else {
                unset($validatedDataUser['password']);
            }
            $studentOrganization->update($validatedDataStudentOrganization);
            $studentOrganization->user->update($validatedDataUser);

            return redirect()->route('student-organization.index')->with('success', 'Berhasil mengedit ormawa!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal mengedit ormawa!');
        }
    }

    public function destroy(StudentOrganization $studentOrganization)
    {
        try {
            $studentOrganization->load('user');
            if ($studentOrganization->image_path && File::exists(public_path('assets/image/student-organization/' . $studentOrganization->image_path))) {
                File::delete(public_path('assets/image/student-organization/' . $studentOrganization->image_path));
            }
            $studentOrganization->user->delete();
            $studentOrganization->delete();
            return redirect()->route('student-organization.index')->with('success', 'Berhasil menghapus ormawa!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menghapus ormawa!');
        }
    }
}
