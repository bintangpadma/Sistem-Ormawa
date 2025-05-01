<?php

namespace App\Http\Controllers;

use App\Models\StudentActivityUnit;
use App\Models\StudentActivityUnitStructure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StudentActivityUnitStructureController extends Controller
{
    public function index(StudentActivityUnit $studentActivityUnit, Request $request)
    {
        $search = $request->input('search');
        $studentActivityUnitStructures = StudentActivityUnitStructure::where('student_activity_units_id', $studentActivityUnit->id)
            ->when($search, function ($query, $search) {
                $query->where('student_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('student_code', 'LIKE', '%' . $search . '%')
                    ->orWhere('role', 'LIKE', '%' . $search . '%');
            })->latest()->paginate(10);

        return view('dashboard.student-activity-unit-structure.index', [
            'page' => 'Halaman Struktur',
            'studentActivityUnitStructures' => $studentActivityUnitStructures,
            'studentActivityUnit' => $studentActivityUnit,
            'search' => $search,
        ]);
    }

    public function show(StudentActivityUnit $studentActivityUnit, StudentActivityUnitStructure $studentActivityUnitStructure)
    {
        return response()->json([
            'status_code' => 200,
            'student_activity_unit' => $studentActivityUnit,
            'student_activity_unit_structure' => $studentActivityUnitStructure,
        ]);
    }

    public function store(StudentActivityUnit $studentActivityUnit, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'profile_path' => 'required|file|image|mimes:png,jpg,jpeg,gif,webp,svg|max:2048',
                'student_name' => 'required|string|max:255',
                'student_code' => 'required|string|max:50',
                'role' => 'required|string|max:100',
            ]);

            if ($request->hasFile('profile_path')) {
                $imageFile = $request->file('profile_path');
                $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path('assets/image/structure'), $imageName);
                $validatedData['profile_path'] = $imageName;
            }

            $validatedData['student_activity_units_id'] = $studentActivityUnit->id;
            StudentActivityUnitStructure::create($validatedData);
            return redirect()->back()->with('success', 'Berhasil menambahkan struktur baru!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menambahkan struktur baru!');
        }
    }

    public function update(StudentActivityUnit $studentActivityUnit, StudentActivityUnitStructure $studentActivityUnitStructure, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'profile_path' => 'nullable|file|image|mimes:png,jpg,jpeg,gif,webp,svg|max:2048',
                'student_name' => 'required|string|max:255',
                'student_code' => 'required|string|max:50',
                'role' => 'required|string|max:100',
            ]);

            if ($request->hasFile('profile_path')) {
                $imageFile = $request->file('profile_path');
                $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
                if ($studentActivityUnitStructure->profile_path && File::exists(public_path('assets/image/structure/' . $studentActivityUnitStructure->profile_path))) {
                    File::delete(public_path('assets/image/structure/' . $studentActivityUnitStructure->profile_path));
                }
                $imageFile->move(public_path('assets/image/structure'), $imageName);
                $validatedData['profile_path'] = $imageName;
            } else {
                $validatedData['profile_path'] = $studentActivityUnitStructure->profile_path;
            }

            $studentActivityUnitStructure->update($validatedData);
            return redirect()->back()->with('success', 'Berhasil mengedit struktur!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal mengedit struktur!');
        }
    }

    public function destroy(StudentActivityUnit $studentActivityUnit, StudentActivityUnitStructure $studentActivityUnitStructure)
    {
        try {
            if ($studentActivityUnitStructure->profile_path && File::exists(public_path('assets/image/structure/' . $studentActivityUnitStructure->profile_path))) {
                File::delete(public_path('assets/image/structure/' . $studentActivityUnitStructure->profile_path));
            }
            $studentActivityUnitStructure->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus struktur!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menghapus struktur!');
        }
    }
}
