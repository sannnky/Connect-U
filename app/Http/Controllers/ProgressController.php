<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use App\Models\Project;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function index()
    {
        $progress = Progress::with('project')->get();
        return view('progress.index', compact('progress'));
    }

    public function create()
    {
        $projects = Project::all();
        return view('progress.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'progress_date' => 'required|date',
            'attachment_id' => 'nullable|exists:attachments,id'
        ]);
        Progress::create($request->all());
        return redirect()->route('progress.index')->with('success', 'Progress berhasil ditambahkan');
    }

    public function show(Progress $progress)
    {
        $progress->load('project', 'attachment');
        return view('progress.show', compact('progress'));
    }

    public function edit(Progress $progress)
    {
        $projects = Project::all();
        return view('progress.edit', compact('progress', 'projects'));
    }

    public function update(Request $request, Progress $progress)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'progress_date' => 'required|date',
            'attachment_id' => 'nullable|exists:attachments,id'
        ]);
        $progress->update($request->all());
        return redirect()->route('progress.show', $progress->id)->with('success', 'Progress berhasil diupdate');
    }

    public function destroy(Progress $progress)
    {
        $progress->delete();
        return redirect()->route('progress.index')->with('success', 'Progress berhasil dihapus');
    }
}
