<?php

namespace App\Http\Controllers;

use App\Models\ActivityReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActivityReportController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $isStudentOrganization = auth()->user()->student_organization;
        $isStudentActivityUnit = auth()->user()->student_activity_unit;
        $activityReports = ActivityReport::with(['student_organization', 'student_activity_unit'])
            ->when($isStudentOrganization, function ($query) use ($isStudentOrganization) {
                $query->where('student_organizations_id', $isStudentOrganization->id);
            })
            ->when($isStudentActivityUnit, function ($query) use ($isStudentActivityUnit) {
                $query->where('student_activity_units_id', $isStudentActivityUnit->id);
            })
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('description', 'LIKE', '%' . $search . '%')
                    ->orWhere('status', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('student_organization', function ($query) use ($search) {
                        $query->where('name', 'LIKE', '%' . $search . '%')
                            ->orWhere('abbreviation', 'LIKE', '%' . $search . '%');
                    })->orWhereHas('student_activity_unit', function ($query) use ($search) {
                        $query->where('name', 'LIKE', '%' . $search . '%')
                            ->orWhere('abbreviation', 'LIKE', '%' . $search . '%');
                    });
            })->latest()->paginate(10);

        return view('dashboard.activity-report.index', [
            'page' => 'Halaman Arsip Administrasi',
            'activityReports' => $activityReports,
            'search' => $search,
        ]);
    }

    public function download(ActivityReport $activityReport)
    {
        $filePath = 'assets/file/lpj/' . $activityReport->file_path;
        if (Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->download($filePath);
        }
        return redirect()->back()->with('failed', 'File tidak ditemukan!');
    }

    public function show(ActivityReport $activityReport)
    {
        $activityReport->load(['student_organization', 'student_activity_unit']);

        return view('dashboard.activity-report.detail', [
            'page' => 'Halaman Detail Arsip Administrasi',
            'activityReport' => $activityReport,
        ]);
    }

    public function create()
    {
        return view('dashboard.activity-report.create', [
            'page' => 'Halaman Tambah Arsip Administrasi',
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'student_organizations_id' => 'nullable|required_without:student_activity_units_id',
                'student_activity_units_id' => 'nullable|required_without:student_organizations_id',
                'file_path' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
                'name' => 'required|string|max:100',
                'description' => 'required|string|max:255',
            ]);
            $validatedData['status'] = 'accepted';

            if ($request->hasFile('file_path')) {
                $file = $request->file('file_path');
                $path = $file->store('assets/file/lpj', 'public');
                $validatedData['file_path'] = basename($path);
            }

            ActivityReport::create($validatedData);

            return redirect()->route('activity-report.index')->with('success', 'Berhasil menambahkan arsip administrasi baru!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menambahkan arsip administrasi baru!');
        }
    }

    public function edit(ActivityReport $activityReport)
    {
        $activityReport->load(['student_organization', 'student_activity_unit']);

        return view('dashboard.activity-report.edit', [
            'page' => 'Halaman Edit Arsip Administrasi',
            'activityReport' => $activityReport,
        ]);
    }

    public function update(Request $request, ActivityReport $activityReport)
    {
        try {
            $validatedData = $request->validate([
                'file_path' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
                'name' => 'required|string|max:100',
                'description' => 'required|string|max:255',
                'status' => 'nullable|string|max:50',
            ]);

            if ($request->hasFile('file_path')) {
                if ($activityReport->file_path && Storage::disk('public')->exists('assets/file/lpj/' . $activityReport->file_path)) {
                    Storage::disk('public')->delete('assets/file/lpj/' . $activityReport->file_path);
                }
                $file = $request->file('file_path');
                $path = $file->store('assets/file/lpj', 'public');
                $validatedData['file_path'] = basename($path);
            } else {
                $validatedData['file_path'] = $activityReport->file_path;
            }

            $activityReport->update($validatedData);

            return redirect()->route('activity-report.index')->with('success', 'Berhasil mengedit arsip administrasi!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal mengedit arsip administrasi!');
        }
    }

    public function destroy(ActivityReport $activityReport)
    {
        try {
            if ($activityReport->file_path && Storage::disk('public')->exists('assets/file/lpj/' . $activityReport->file_path)) {
                Storage::disk('public')->delete('assets/file/lpj/' . $activityReport->file_path);
            }
            $activityReport->delete();
            return redirect()->route('activity-report.index')->with('success', 'Berhasil menghapus arsip administrasi!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menghapus arsip administrasi!');
        }
    }
}
