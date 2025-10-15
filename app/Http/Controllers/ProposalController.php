<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Project;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    public function index()
    {
        $proposals = Proposal::with('project')->get();
        return view('proposals.index', compact('proposals'));
    }

    public function create()
    {
        $projects = Project::all();
        return view('proposals.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'filename' => 'required|string|max:255',
            'filepath' => 'required|string',
            'project_id' => 'required|exists:projects,id',
            'status' => 'in:Draft,Review,Revisi,Lolos,Ditolak'
        ]);
        Proposal::create($request->all());
        return redirect()->route('proposals.index')->with('success', 'Proposal berhasil diupload');
    }

    public function show(Proposal $proposal)
    {
        $proposal->load('project');
        return view('proposals.show', compact('proposal'));
    }

    public function edit(Proposal $proposal)
    {
        $projects = Project::all();
        return view('proposals.edit', compact('proposal', 'projects'));
    }

    public function update(Request $request, Proposal $proposal)
    {
        $request->validate([
            'filename' => 'required|string|max:255',
            'filepath' => 'required|string',
            'project_id' => 'required|exists:projects,id',
            'status' => 'in:Draft,Review,Revisi,Lolos,Ditolak'
        ]);
        $proposal->update($request->all());
        return redirect()->route('proposals.show', $proposal->id)->with('success', 'Proposal berhasil diupdate');
    }

    public function destroy(Proposal $proposal)
    {
        $proposal->delete();
        return redirect()->route('proposals.index')->with('success', 'Proposal berhasil dihapus');
    }
}
