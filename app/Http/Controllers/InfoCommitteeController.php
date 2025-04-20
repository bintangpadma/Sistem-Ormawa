<?php

namespace App\Http\Controllers;

use App\Models\InfoCommittee;
use App\Models\InfoCommitteeDivision;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class InfoCommitteeController extends Controller
{
    public function index(Request $request)
    {
        $infoCommittees = InfoCommittee::with('info_committee_divisions')->latest()->paginate(10);

        return view('dashboard.info-committee.index', [
            'page' => 'Halaman Info Panitia',
            'infoCommittees' => $infoCommittees,
        ]);
    }

    public function show(InfoCommittee $infoCommittee)
    {
        return response()->json([
            'status_code' => 200,
            'info_committee' => $infoCommittee,
            'total_division' => $infoCommittee->info_committee_divisions()->count(),
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'committee_definition' => 'required|string',
            ]);
            InfoCommittee::create($validatedData);
            return redirect()->back()->with('success', 'Berhasil menambahkan info panitia baru!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menambahkan info panitia baru!');
        }
    }

    public function update(Request $request, InfoCommittee $infoCommittee)
    {
        try {
            $infoCommittee->load('info_committee_divisions');
            $validatedData = $request->validate([
                'committee_definition' => 'required|string',
            ]);
            $infoCommittee->update($validatedData);
            return redirect()->route('info-committee.index')->with('success', 'Berhasil mengedit info panitia!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal mengedit info panitia!');
        }
    }

    public function destroy(InfoCommittee $infoCommittee)
    {
        try {
            $infoCommittee->delete();
            return redirect()->route('info-committee.index')->with('success', 'Berhasil menghapus info panitia!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menghapus info panitia!');
        }
    }
}
