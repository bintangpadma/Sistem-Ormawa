<?php

namespace App\Http\Controllers;

use App\Models\StudentOrganization;
use App\Models\StudentOrganizationDivision;
use App\Models\StudentOrganizationDivisionTask;
use Illuminate\Http\Request;

class StudentOrganizationDivisionTaskController extends Controller
{
    public function index(StudentOrganization $studentOrganization, StudentOrganizationDivision $studentOrganizationDivision, Request $request)
    {
        $search = $request->input('search');
        $studentOrganizationDivisionTasks = StudentOrganizationDivisionTask::where('divisions_id', $studentOrganizationDivision->id)
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })->latest()->paginate(10);

        return view('dashboard.student-organization-division-task.index', [
            'page' => 'Halaman Tugas Divisi Organisasi Mahasiswa',
            'studentOrganization' => $studentOrganization,
            'studentOrganizationDivision' => $studentOrganizationDivision,
            'studentOrganizationDivisionTasks' => $studentOrganizationDivisionTasks,
            'search' => $search,
        ]);
    }

    public function show(StudentOrganization $studentOrganization, StudentOrganizationDivision $studentOrganizationDivision, StudentOrganizationDivisionTask $studentOrganizationDivisionTask)
    {
        return response()->json([
            'status_code' => 200,
            'student_organization' => $studentOrganization,
            'student_organization_division' => $studentOrganizationDivision,
            'student_organization_division_task' => $studentOrganizationDivisionTask,
        ]);
    }

    public function store(StudentOrganization $studentOrganization, StudentOrganizationDivision $studentOrganizationDivision, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:150',
            ]);
            $validatedData['divisions_id'] = $studentOrganizationDivision->id;
            StudentOrganizationDivisionTask::create($validatedData);
            return redirect()->back()->with('success', 'Berhasil menambahkan tugas divisi organisasi mahasiswa baru!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menambahkan tugas divisi organisasi mahasiswa baru!');
        }
    }

    public function update(StudentOrganization $studentOrganization, StudentOrganizationDivision $studentOrganizationDivision, StudentOrganizationDivisionTask $studentOrganizationDivisionTask, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:150',
            ]);
            $studentOrganizationDivisionTask->update($validatedData);
            return redirect()->back()->with('success', 'Berhasil mengedit tugas divisi organisasi mahasiswa!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal mengedit tugas divisi organisasi mahasiswa!');
        }
    }

    public function destroy(StudentOrganization $studentOrganization, StudentOrganizationDivision $studentOrganizationDivision, StudentOrganizationDivisionTask $studentOrganizationDivisionTask)
    {
        try {
            $studentOrganizationDivisionTask->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus tugas divisi organisasi mahasiswa!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menghapus tugas divisi organisasi mahasiswa!');
        }
    }
}
