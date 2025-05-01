<?php

namespace App\Http\Controllers;

use App\Models\StudentActivityUnit;
use App\Models\StudentActivityUnitProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StudentActivityUnitProgramController extends Controller
{
    public function index(StudentActivityUnit $studentActivityUnit, Request $request)
    {
        $search = $request->input('search');
        $studentActivityUnitPrograms = StudentActivityUnitProgram::where('student_activity_units_id', $studentActivityUnit->id)
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('description', 'LIKE', '%' . $search . '%');
            })->latest()->paginate(10);

        return view('dashboard.student-activity-unit-program.index', [
            'page' => 'Halaman Program',
            'studentActivityUnitPrograms' => $studentActivityUnitPrograms,
            'studentActivityUnit' => $studentActivityUnit,
            'search' => $search,
        ]);
    }

    public function show(StudentActivityUnit $studentActivityUnit, StudentActivityUnitProgram $studentActivityUnitProgram)
    {
        return response()->json([
            'status_code' => 200,
            'student_activity_unit' => $studentActivityUnit,
            'student_activity_unit_program' => $studentActivityUnitProgram,
        ]);
    }

    public function store(StudentActivityUnit $studentActivityUnit, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'image_path' => 'required|file|image|mimes:png,jpg,jpeg,gif,webp,svg|max:2048',
                'name' => 'required|string',
                'description' => 'required|string',
            ]);

            if ($request->hasFile('image_path')) {
                $imageFile = $request->file('image_path');
                $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path('assets/image/program'), $imageName);
                $validatedData['image_path'] = $imageName;
            }

            $validatedData['student_activity_units_id'] = $studentActivityUnit->id;
            StudentActivityUnitProgram::create($validatedData);
            return redirect()->back()->with('success', 'Berhasil menambahkan program baru!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menambahkan program baru!');
        }
    }

    public function update(StudentActivityUnit $studentActivityUnit, StudentActivityUnitProgram $studentActivityUnitProgram, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'image_path' => 'nullable|file|image|mimes:png,jpg,jpeg,gif,webp,svg|max:2048',
                'name' => 'required|string',
                'description' => 'required|string',
            ]);

            if ($request->hasFile('image_path')) {
                $imageFile = $request->file('image_path');
                $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
                if ($studentActivityUnitProgram->image_path && File::exists(public_path('assets/image/program/' . $studentActivityUnitProgram->image_path))) {
                    File::delete(public_path('assets/image/program/' . $studentActivityUnitProgram->image_path));
                }
                $imageFile->move(public_path('assets/image/program'), $imageName);
                $validatedData['image_path'] = $imageName;
            } else {
                $validatedData['image_path'] = $studentActivityUnitProgram->image_path;
            }

            $studentActivityUnitProgram->update($validatedData);
            return redirect()->back()->with('success', 'Berhasil mengedit program!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal mengedit program!');
        }
    }

    public function destroy(StudentActivityUnit $studentActivityUnit, StudentActivityUnitProgram $studentActivityUnitProgram)
    {
        try {
            if ($studentActivityUnitProgram->image_path && File::exists(public_path('assets/image/program/' . $studentActivityUnitProgram->image_path))) {
                File::delete(public_path('assets/image/program/' . $studentActivityUnitProgram->image_path));
            }
            $studentActivityUnitProgram->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus program!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menghapus program!');
        }
    }
}
