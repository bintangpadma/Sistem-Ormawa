<?php

namespace App\Http\Controllers;

use App\Models\StudentOrganization;
use App\Models\StudentOrganizationProgram;
use Illuminate\Http\Request;

class StudentOrganizationProgramController extends Controller
{
    public function index(StudentOrganization $studentOrganization, Request $request)
    {
        $search = $request->input('search');
        $studentOrganizationPrograms = StudentOrganizationProgram::where('student_organizations_id', $studentOrganization->id)
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('description', 'LIKE', '%' . $search . '%');
            })->latest()->paginate(10);

        return view('dashboard.student-organization-program.index', [
            'page' => 'Halaman Program',
            'studentOrganizationPrograms' => $studentOrganizationPrograms,
            'studentOrganization' => $studentOrganization,
            'search' => $search,
        ]);
    }

    public function show(StudentOrganization $studentOrganization, StudentOrganizationProgram $studentOrganizationProgram)
    {
        return response()->json([
            'status_code' => 200,
            'student_organization' => $studentOrganization,
            'student_organization_program' => $studentOrganizationProgram,
        ]);
    }

    public function store(StudentOrganization $studentOrganization, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:150',
                'description' => 'required|string',
            ]);
            $validatedData['student_organizations_id'] = $studentOrganization->id;
            StudentOrganizationProgram::create($validatedData);
            return redirect()->back()->with('success', 'Berhasil menambahkan program baru!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menambahkan program baru!');
        }
    }

    public function update(StudentOrganization $studentOrganization, StudentOrganizationProgram $studentOrganizationProgram, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:150',
                'description' => 'required|string',
            ]);
            $studentOrganizationProgram->update($validatedData);
            return redirect()->back()->with('success', 'Berhasil mengedit program!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal mengedit program!');
        }
    }

    public function destroy(StudentOrganization $studentOrganization, StudentOrganizationProgram $studentOrganizationProgram)
    {
        try {
            $studentOrganizationProgram->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus program!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menghapus program!');
        }
    }
}
