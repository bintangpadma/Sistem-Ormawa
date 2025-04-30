<?php

namespace App\Http\Controllers;

use App\Models\StudentOrganization;
use App\Models\StudentOrganizationVision;
use Illuminate\Http\Request;

class StudentOrganizationVisionController extends Controller
{
    public function index(StudentOrganization $studentOrganization, Request $request)
    {
        $search = $request->input('search');
        $studentOrganizationVisions = StudentOrganizationVision::where('student_organizations_id', $studentOrganization->id)
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })->latest()->paginate(10);

        return view('dashboard.student-organization-vision.index', [
            'page' => 'Halaman Visi',
            'studentOrganizationVisions' => $studentOrganizationVisions,
            'studentOrganization' => $studentOrganization,
            'search' => $search,
        ]);
    }

    public function show(StudentOrganization $studentOrganization, StudentOrganizationVision $studentOrganizationVision)
    {
        return response()->json([
            'status_code' => 200,
            'student_organization' => $studentOrganization,
            'student_organization_vision' => $studentOrganizationVision,
        ]);
    }

    public function store(StudentOrganization $studentOrganization, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
            ]);
            $validatedData['student_organizations_id'] = $studentOrganization->id;
            StudentOrganizationVision::create($validatedData);
            return redirect()->back()->with('success', 'Berhasil menambahkan visi baru!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menambahkan visi baru!');
        }
    }

    public function update(StudentOrganization $studentOrganization, StudentOrganizationVision $studentOrganizationVision, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
            ]);
            $studentOrganizationVision->update($validatedData);
            return redirect()->back()->with('success', 'Berhasil mengedit visi!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal mengedit visi!');
        }
    }

    public function destroy(StudentOrganization $studentOrganization, StudentOrganizationVision $studentOrganizationVision)
    {
        try {
            $studentOrganizationVision->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus visi!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menghapus visi!');
        }
    }
}
