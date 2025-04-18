<?php

namespace App\Http\Controllers;

use App\Models\StudentOrganization;
use App\Models\StudentOrganizationStructure;
use Illuminate\Http\Request;

class StudentOrganizationStructureController extends Controller
{
    public function index(StudentOrganization $studentOrganization, Request $request)
    {
        $search = $request->input('search');
        $studentOrganizationStructures = StudentOrganizationStructure::where('student_organizations_id', $studentOrganization->id)
            ->when($search, function ($query, $search) {
                $query->where('student_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('student_code', 'LIKE', '%' . $search . '%')
                    ->orWhere('role', 'LIKE', '%' . $search . '%');
            })->latest()->paginate(10);

        return view('dashboard.student-organization-structure.index', [
            'page' => 'Halaman Struktur',
            'studentOrganizationStructures' => $studentOrganizationStructures,
            'studentOrganization' => $studentOrganization,
            'search' => $search,
        ]);
    }

    public function show(StudentOrganization $studentOrganization, StudentOrganizationStructure $studentOrganizationStructure)
    {
        return response()->json([
            'status_code' => 200,
            'student_organization' => $studentOrganization,
            'student_organization_structure' => $studentOrganizationStructure,
        ]);
    }

    public function store(StudentOrganization $studentOrganization, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'student_name' => 'required|string|max:255',
                'student_code' => 'required|string|max:50',
                'role' => 'required|string|max:100',
            ]);
            $validatedData['student_organizations_id'] = $studentOrganization->id;
            StudentOrganizationStructure::create($validatedData);
            return redirect()->back()->with('success', 'Berhasil menambahkan struktur baru!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menambahkan struktur baru!');
        }
    }

    public function update(StudentOrganization $studentOrganization, StudentOrganizationStructure $studentOrganizationStructure, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'student_name' => 'required|string|max:255',
                'student_code' => 'required|string|max:50',
                'role' => 'required|string|max:100',
            ]);
            $studentOrganizationStructure->update($validatedData);
            return redirect()->back()->with('success', 'Berhasil mengedit struktur!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal mengedit struktur!');
        }
    }

    public function destroy(StudentOrganization $studentOrganization, StudentOrganizationStructure $studentOrganizationStructure)
    {
        try {
            $studentOrganizationStructure->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus struktur!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menghapus struktur!');
        }
    }
}
