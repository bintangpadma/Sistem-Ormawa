<?php

namespace App\Http\Controllers;

use App\Models\StudentActivityUnit;
use App\Models\StudentActivityUnitMission;
use Illuminate\Http\Request;

class StudentActivityUnitMissionController extends Controller
{
    public function index(StudentActivityUnit $studentActivityUnit, Request $request)
    {
        $search = $request->input('search');
        $studentActivityUnitMissions = StudentActivityUnitMission::where('student_activity_units_id', $studentActivityUnit->id)
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })->latest()->paginate(10);

        return view('dashboard.student-activity-unit-mission.index', [
            'page' => 'Halaman Misi',
            'studentActivityUnitMissions' => $studentActivityUnitMissions,
            'studentActivityUnit' => $studentActivityUnit,
            'search' => $search,
        ]);
    }

    public function show(StudentActivityUnit $studentActivityUnit, StudentActivityUnitMission $studentActivityUnitMission)
    {
        return response()->json([
            'status_code' => 200,
            'student_activity_unit' => $studentActivityUnit,
            'student_activity_unit_mission' => $studentActivityUnitMission,
        ]);
    }

    public function store(StudentActivityUnit $studentActivityUnit, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
            ]);
            $validatedData['student_activity_units_id'] = $studentActivityUnit->id;
            StudentActivityUnitMission::create($validatedData);
            return redirect()->back()->with('success', 'Berhasil menambahkan misi baru!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menambahkan misi baru!');
        }
    }

    public function update(StudentActivityUnit $studentActivityUnit, StudentActivityUnitMission $studentActivityUnitMission, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
            ]);
            $studentActivityUnitMission->update($validatedData);
            return redirect()->back()->with('success', 'Berhasil mengedit misi!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal mengedit misi!');
        }
    }

    public function destroy(StudentActivityUnit $studentActivityUnit, StudentActivityUnitMission $studentActivityUnitMission)
    {
        try {
            $studentActivityUnitMission->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus misi!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menghapus misi!');
        }
    }
}
