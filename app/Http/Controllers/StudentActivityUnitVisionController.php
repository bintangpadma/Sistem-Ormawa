<?php

namespace App\Http\Controllers;

use App\Models\StudentActivityUnit;
use App\Models\StudentActivityUnitVision;
use Illuminate\Http\Request;

class StudentActivityUnitVisionController extends Controller
{
    public function index(StudentActivityUnit $studentActivityUnit, Request $request)
    {
        $search = $request->input('search');
        $studentActivityUnitVisions = StudentActivityUnitVision::where('student_activity_units_id', $studentActivityUnit->id)
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })->latest()->paginate(10);

        return view('dashboard.student-activity-unit-vision.index', [
            'page' => 'Halaman Visi',
            'studentActivityUnitVisions' => $studentActivityUnitVisions,
            'studentActivityUnit' => $studentActivityUnit,
            'search' => $search,
        ]);
    }

    public function show(StudentActivityUnit $studentActivityUnit, StudentActivityUnitVision $studentActivityUnitVision)
    {
        return response()->json([
            'status_code' => 200,
            'student_activity_unit' => $studentActivityUnit,
            'student_activity_unit_vision' => $studentActivityUnitVision,
        ]);
    }

    public function store(StudentActivityUnit $studentActivityUnit, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
            ]);
            $validatedData['student_activity_units_id'] = $studentActivityUnit->id;
            StudentActivityUnitVision::create($validatedData);
            return redirect()->back()->with('success', 'Berhasil menambahkan visi baru!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menambahkan visi baru!');
        }
    }

    public function update(StudentActivityUnit $studentActivityUnit, StudentActivityUnitVision $studentActivityUnitVision, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
            ]);
            $studentActivityUnitVision->update($validatedData);
            return redirect()->back()->with('success', 'Berhasil mengedit visi!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal mengedit visi!');
        }
    }

    public function destroy(StudentActivityUnit $studentActivityUnit, StudentActivityUnitVision $studentActivityUnitVision)
    {
        try {
            $studentActivityUnitVision->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus visi!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menghapus visi!');
        }
    }
}
