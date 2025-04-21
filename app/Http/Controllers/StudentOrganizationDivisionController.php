<?php

namespace App\Http\Controllers;

use App\Models\StudentOrganization;
use App\Models\StudentOrganizationDivision;
use Illuminate\Http\Request;

class StudentOrganizationDivisionController extends Controller
{
    public function index(StudentOrganization $studentOrganization, Request $request)
    {
        $search = $request->input('search');
        $studentOrganizationDivisions = StudentOrganizationDivision::where('student_organizations_id', $studentOrganization->id)
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('definition', 'LIKE', '%' . $search . '%');
            })->latest()->paginate(10);

        return view('dashboard.student-organization-division.index', [
            'page' => 'Halaman Organisasi Mahasiswa Divisi',
            'studentOrganizationDivisions' => $studentOrganizationDivisions,
            'studentOrganization' => $studentOrganization,
            'search' => $search,
        ]);
    }

    public function show(StudentOrganization $studentOrganization, StudentOrganizationDivision $studentOrganizationDivision)
    {
        return response()->json([
            'status_code' => 200,
            'student_organization' => $studentOrganization,
            'student_organization_division' => $studentOrganizationDivision,
            'student_organization_division_tasks' => $studentOrganizationDivision->load('student_organization_division_tasks')->student_organization_division_tasks()->count(),
        ]);
    }

    public function store(StudentOrganization $studentOrganization, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:50',
                'definition' => 'required|string',
            ]);
            $validatedData['student_organizations_id'] = $studentOrganization->id;
            StudentOrganizationDivision::create($validatedData);
            return redirect()->back()->with('success', 'Berhasil menambahkan organisasi mahasiswa divisi baru!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menambahkan organisasi mahasiswa divisi baru!');
        }
    }

    public function update(StudentOrganization $studentOrganization, StudentOrganizationDivision $studentOrganizationDivision, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:50',
                'definition' => 'required|string',
            ]);
            $studentOrganizationDivision->update($validatedData);
            return redirect()->back()->with('success', 'Berhasil mengedit organisasi mahasiswa divisi!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal mengedit organisasi mahasiswa divisi!');
        }
    }

    public function destroy(StudentOrganization $studentOrganization, StudentOrganizationDivision $studentOrganizationDivision)
    {
        try {
            $studentOrganizationDivision->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus organisasi mahasiswa divisi!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menghapus organisasi mahasiswa divisi!');
        }
    }
}
