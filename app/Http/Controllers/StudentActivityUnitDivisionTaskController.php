<?php

namespace App\Http\Controllers;

use App\Models\StudentActivityUnit;
use App\Models\StudentActivityUnitDivision;
use App\Models\StudentActivityUnitDivisionTask;
use Illuminate\Http\Request;

class StudentActivityUnitDivisionTaskController extends Controller
{
    public function index(StudentActivityUnit $studentActivityUnit, StudentActivityUnitDivision $studentActivityUnitDivision, Request $request)
    {
        $search = $request->input('search');
        $studentActivityUnitDivisionTasks = StudentActivityUnitDivisionTask::where('divisions_id', $studentActivityUnitDivision->id)
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })->latest()->paginate(10);

        return view('dashboard.student-activity-unit-division-task.index', [
            'page' => 'Halaman Tugas Divisi UKM',
            'studentActivityUnit' => $studentActivityUnit,
            'studentActivityUnitDivision' => $studentActivityUnitDivision,
            'studentActivityUnitDivisionTasks' => $studentActivityUnitDivisionTasks,
            'search' => $search,
        ]);
    }

    public function show(StudentActivityUnit $studentActivityUnit, StudentActivityUnitDivision $studentActivityUnitDivision, StudentActivityUnitDivisionTask $studentActivityUnitDivisionTask)
    {
        return response()->json([
            'status_code' => 200,
            'student_activity_unit' => $studentActivityUnit,
            'student_activity_unit_division' => $studentActivityUnitDivision,
            'student_activity_unit_division_task' => $studentActivityUnitDivisionTask,
        ]);
    }

    public function store(StudentActivityUnit $studentActivityUnit, StudentActivityUnitDivision $studentActivityUnitDivision, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
            ]);
            $validatedData['divisions_id'] = $studentActivityUnitDivision->id;
            StudentActivityUnitDivisionTask::create($validatedData);
            return redirect()->back()->with('success', 'Berhasil menambahkan tugas divisi ukm baru!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menambahkan tugas divisi ukm baru!');
        }
    }

    public function update(StudentActivityUnit $studentActivityUnit, StudentActivityUnitDivision $studentActivityUnitDivision, StudentActivityUnitDivisionTask $studentActivityUnitDivisionTask, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
            ]);
            $studentActivityUnitDivisionTask->update($validatedData);
            return redirect()->back()->with('success', 'Berhasil mengedit tugas divisi ukm!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal mengedit tugas divisi ukm!');
        }
    }

    public function destroy(StudentActivityUnit $studentActivityUnit, StudentActivityUnitDivision $studentActivityUnitDivision, StudentActivityUnitDivisionTask $studentActivityUnitDivisionTask)
    {
        try {
            $studentActivityUnitDivisionTask->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus tugas divisi ukm!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menghapus tugas divisi ukm!');
        }
    }
}
