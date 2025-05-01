<?php

namespace App\Http\Controllers;

use App\Models\StudentActivityUnit;
use App\Models\StudentActivityUnitDivision;
use Illuminate\Http\Request;

class StudentActivityUnitDivisionController extends Controller
{
    public function index(StudentActivityUnit $studentActivityUnit, Request $request)
    {
        $search = $request->input('search');
        $studentActivityUnitDivisions = StudentActivityUnitDivision::where('student_activity_units_id', $studentActivityUnit->id)
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('definition', 'LIKE', '%' . $search . '%');
            })->latest()->paginate(10);

        return view('dashboard.student-activity-unit-division.index', [
            'page' => 'Halaman UKM Divisi',
            'studentActivityUnitDivisions' => $studentActivityUnitDivisions,
            'studentActivityUnit' => $studentActivityUnit,
            'search' => $search,
        ]);
    }

    public function show(StudentActivityUnit $studentActivityUnit, StudentActivityUnitDivision $studentActivityUnitDivision)
    {
        return response()->json([
            'status_code' => 200,
            'student_activity_unit' => $studentActivityUnit,
            'student_activity_unit_division' => $studentActivityUnitDivision,
            'student_activity_unit_division_tasks' => $studentActivityUnitDivision->load('student_activity_unit_division_tasks')->student_activity_unit_division_tasks()->count(),
        ]);
    }

    public function store(StudentActivityUnit $studentActivityUnit, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:50',
                'definition' => 'required|string',
            ]);
            $validatedData['student_activity_units_id'] = $studentActivityUnit->id;
            StudentActivityUnitDivision::create($validatedData);
            return redirect()->back()->with('success', 'Berhasil menambahkan ukm divisi baru!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menambahkan ukm divisi baru!');
        }
    }

    public function update(StudentActivityUnit $studentActivityUnit, StudentActivityUnitDivision $studentActivityUnitDivision, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:50',
                'definition' => 'required|string',
            ]);
            $studentActivityUnitDivision->update($validatedData);
            return redirect()->back()->with('success', 'Berhasil mengedit ukm divisi!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal mengedit ukm divisi!');
        }
    }

    public function destroy(StudentActivityUnit $studentActivityUnit, StudentActivityUnitDivision $studentActivityUnitDivision)
    {
        try {
            $studentActivityUnitDivision->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus ukm divisi!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menghapus ukm divisi!');
        }
    }
}
