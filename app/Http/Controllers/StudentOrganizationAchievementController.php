<?php

namespace App\Http\Controllers;

use App\Models\StudentOrganization;
use App\Models\StudentOrganizationAchievement;
use Illuminate\Http\Request;

class StudentOrganizationAchievementController extends Controller
{
    public function index(StudentOrganization $studentOrganization, Request $request)
    {
        $search = $request->input('search');
        $studentOrganizationAchievements = StudentOrganizationAchievement::where('student_organizations_id', $studentOrganization->id)
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('description', 'LIKE', '%' . $search . '%');
            })->latest()->paginate(10);

        return view('dashboard.student-organization-achievement.index', [
            'page' => 'Halaman Prestasi',
            'studentOrganizationAchievements' => $studentOrganizationAchievements,
            'studentOrganization' => $studentOrganization,
            'search' => $search,
        ]);
    }

    public function show(StudentOrganization $studentOrganization, StudentOrganizationAchievement $studentOrganizationAchievement)
    {
        return response()->json([
            'status_code' => 200,
            'student_organization' => $studentOrganization,
            'student_organization_achievement' => $studentOrganizationAchievement,
        ]);
    }

    public function store(StudentOrganization $studentOrganization, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'description' => 'required|string',
            ]);
            $validatedData['student_organizations_id'] = $studentOrganization->id;
            StudentOrganizationAchievement::create($validatedData);
            return redirect()->back()->with('success', 'Berhasil menambahkan prestasi baru!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menambahkan prestasi baru!');
        }
    }

    public function update(StudentOrganization $studentOrganization, StudentOrganizationAchievement $studentOrganizationAchievement, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'description' => 'required|string',
            ]);
            $studentOrganizationAchievement->update($validatedData);
            return redirect()->back()->with('success', 'Berhasil mengedit prestasi!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal mengedit prestasi!');
        }
    }

    public function destroy(StudentOrganization $studentOrganization, StudentOrganizationAchievement $studentOrganizationAchievement)
    {
        try {
            $studentOrganizationAchievement->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus prestasi!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menghapus prestasi!');
        }
    }
}
