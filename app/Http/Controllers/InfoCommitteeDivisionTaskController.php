<?php

namespace App\Http\Controllers;

use App\Models\InfoCommittee;
use App\Models\InfoCommitteeDivision;
use App\Models\InfoCommitteeDivisionTask;
use Illuminate\Http\Request;

class InfoCommitteeDivisionTaskController extends Controller
{
    public function index(InfoCommittee $infoCommittee, InfoCommitteeDivision $infoCommitteeDivision, Request $request)
    {
        $search = $request->input('search');
        $infoCommitteeDivisionTasks = InfoCommitteeDivisionTask::where('info_committee_divisions_id', $infoCommitteeDivision->id)
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })->latest()->paginate(10);

        return view('dashboard.info-committee-division-task.index', [
            'page' => 'Halaman Tugas Divisi Panitia',
            'infoCommittee' => $infoCommittee,
            'infoCommitteeDivision' => $infoCommitteeDivision,
            'infoCommitteeDivisionTasks' => $infoCommitteeDivisionTasks,
            'search' => $search,
        ]);
    }

    public function show(InfoCommittee $infoCommittee, InfoCommitteeDivision $infoCommitteeDivision, InfoCommitteeDivisionTask $infoCommitteeDivisionTask)
    {
        return response()->json([
            'status_code' => 200,
            'info_committee' => $infoCommittee,
            'info_committee_division' => $infoCommitteeDivision,
            'info_committee_division_task' => $infoCommitteeDivisionTask,
        ]);
    }

    public function store(InfoCommittee $infoCommittee, InfoCommitteeDivision $infoCommitteeDivision, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
            ]);
            $validatedData['info_committee_divisions_id'] = $infoCommitteeDivision->id;
            InfoCommitteeDivisionTask::create($validatedData);
            return redirect()->back()->with('success', 'Berhasil menambahkan tugas divisi panitia baru!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menambahkan tugas divisi panitia baru!');
        }
    }

    public function update(InfoCommittee $infoCommittee, InfoCommitteeDivision $infoCommitteeDivision, InfoCommitteeDivisionTask $infoCommitteeDivisionTask, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
            ]);
            $infoCommitteeDivisionTask->update($validatedData);
            return redirect()->back()->with('success', 'Berhasil mengedit tugas divisi panitia!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal mengedit tugas divisi panitia!');
        }
    }

    public function destroy(InfoCommittee $infoCommittee, InfoCommitteeDivision $infoCommitteeDivision, InfoCommitteeDivisionTask $infoCommitteeDivisionTask)
    {
        try {
            $infoCommitteeDivisionTask->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus tugas divisi panitia!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menghapus tugas divisi panitia!');
        }
    }
}
