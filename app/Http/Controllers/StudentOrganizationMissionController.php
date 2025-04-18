<?php

namespace App\Http\Controllers;

use App\Models\StudentOrganization;
use App\Models\StudentOrganizationMission;
use Illuminate\Http\Request;

class StudentOrganizationMissionController extends Controller
{
    public function index(StudentOrganization $studentOrganization, Request $request)
    {
        $search = $request->input('search');
        $studentOrganizationMissions = StudentOrganizationMission::where('student_organizations_id', $studentOrganization->id)
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })->latest()->paginate(10);

        return view('dashboard.student-organization-mission.index', [
            'page' => 'Halaman Misi',
            'studentOrganizationMissions' => $studentOrganizationMissions,
            'studentOrganization' => $studentOrganization,
            'search' => $search,
        ]);
    }

    public function show(StudentOrganization $studentOrganization, StudentOrganizationMission $studentOrganizationMission)
    {
        return response()->json([
            'status_code' => 200,
            'student_organization' => $studentOrganization,
            'student_organization_mission' => $studentOrganizationMission,
        ]);
    }

    public function store(StudentOrganization $studentOrganization, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:150',
            ]);
            $validatedData['student_organizations_id'] = $studentOrganization->id;
            StudentOrganizationMission::create($validatedData);
            return redirect()->back()->with('success', 'Berhasil menambahkan misi baru!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menambahkan misi baru!');
        }
    }

    public function update(StudentOrganization $studentOrganization, StudentOrganizationMission $studentOrganizationMission, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:150',
            ]);
            $studentOrganizationMission->update($validatedData);
            return redirect()->back()->with('success', 'Berhasil mengedit misi!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal mengedit misi!');
        }
    }

    public function destroy(StudentOrganization $studentOrganization, StudentOrganizationMission $studentOrganizationMission)
    {
        try {
            $studentOrganizationMission->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus misi!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menghapus misi!');
        }
    }
}
