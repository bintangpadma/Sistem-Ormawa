<?php

namespace App\Http\Controllers;

use App\Models\StudentActivityUnit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class StudentActivityUnitController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $studentActivityUnits = StudentActivityUnit::when($search, function ($query, $search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('abbreviation', 'LIKE', '%' . $search . '%')
                    ->orWhere('description', 'LIKE', '%' . $search . '%');
            })->latest()->paginate(10);

        return view('dashboard.student-activity-unit.index', [
            'page' => 'Halaman UKM',
            'studentActivityUnits' => $studentActivityUnits,
            'search' => $search,
        ]);
    }

    public function show(StudentActivityUnit $studentActivityUnit)
    {
        $studentActivityUnit->load('user');

        return view('dashboard.student-activity-unit.detail', [
            'page' => 'Halaman Detail UKM',
            'studentActivityUnit' => $studentActivityUnit,
        ]);
    }

    public function create()
    {
        return view('dashboard.student-activity-unit.create', [
            'page' => 'Halaman Tambah UKM',
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validatedDataStudentActivityUnit = $request->validate([
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
                $imageFile->move(public_path('assets/image/student-activity-unit'), $imageName);
                $validatedDataStudentActivityUnit['image_path'] = $imageName;
            }

            $validatedDataUser['password'] = Hash::make($validatedDataUser['password']);
            $studentActivityUnit = StudentActivityUnit::create($validatedDataStudentActivityUnit);
            $validatedDataUser['student_activity_units_id'] = $studentActivityUnit->id;
            User::create($validatedDataUser);

            return redirect()->route('student-activity-unit.index')->with('success', 'Berhasil menambahkan ukm baru!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menambahkan ukm baru!');
        }
    }

    public function edit(StudentActivityUnit $studentActivityUnit)
    {
        $studentActivityUnit->load('user');

        return view('dashboard.student-activity-unit.edit', [
            'page' => 'Halaman Edit UKM',
            'studentActivityUnit' => $studentActivityUnit,
        ]);
    }

    public function update(StudentActivityUnit $studentActivityUnit, Request $request)
    {
        try {
            $studentActivityUnit->load('user');
            $validatedDataStudentActivityUnit = $request->validate([
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
                if ($studentActivityUnit->image_path && File::exists(public_path('assets/image/student-activity-unit/' . $studentActivityUnit->image_path))) {
                    File::delete(public_path('assets/image/student-activity-unit/' . $studentActivityUnit->image_path));
                }
                $imageFile->move(public_path('assets/image/student-activity-unit'), $imageName);
                $validatedDataStudentActivityUnit['image_path'] = $imageName;
            } else {
                $validatedDataStudentActivityUnit['image_path'] = $studentActivityUnit->image_path;
            }

            if (!empty($validatedDataUser['password'])) {
                $validatedDataUser['password'] = Hash::make($validatedDataUser['password']);
            } else {
                unset($validatedDataUser['password']);
            }
            $studentActivityUnit->update($validatedDataStudentActivityUnit);
            $studentActivityUnit->user->update($validatedDataUser);

            return redirect()->route('student-activity-unit.index')->with('success', 'Berhasil mengedit ukm!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal mengedit ukm!');
        }
    }

    public function destroy(StudentActivityUnit $studentActivityUnit)
    {
        try {
            $studentActivityUnit->load('user');
            if ($studentActivityUnit->image_path && File::exists(public_path('assets/image/student-activity-unit/' . $studentActivityUnit->image_path))) {
                File::delete(public_path('assets/image/student-activity-unit/' . $studentActivityUnit->image_path));
            }
            $studentActivityUnit->user->delete();
            $studentActivityUnit->delete();
            return redirect()->route('student-activity-unit.index')->with('success', 'Berhasil menghapus ukm!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menghapus ukm!');
        }
    }
}
