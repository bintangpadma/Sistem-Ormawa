<?php

namespace App\Http\Controllers;

use App\Models\StudentActivityUnit;
use Illuminate\Http\Request;

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
        return response()->json([
            'status_code' => 200,
            'student_activity_unit' => $studentActivityUnit,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:100',
                'abbreviation' => 'required|string|max:50',
                'description' => 'required|string',
            ]);
            StudentActivityUnit::create($validatedData);
            return redirect()->back()->with('success', 'Berhasil menambahkan ukm baru!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menambahkan ukm baru!');
        }
    }

    public function update(StudentActivityUnit $studentActivityUnit, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:100',
                'abbreviation' => 'required|string|max:50',
                'description' => 'required|string',
            ]);
            $studentActivityUnit->update($validatedData);
            return redirect()->back()->with('success', 'Berhasil mengedit ukm!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal mengedit ukm!');
        }
    }

    public function destroy(StudentActivityUnit $studentActivityUnit)
    {
        try {
            $studentActivityUnit->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus ukm!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menghapus ukm!');
        }
    }
}
