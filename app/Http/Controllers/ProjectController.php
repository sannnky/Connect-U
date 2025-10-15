<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\Project;
use App\Models\Team;
use App\Models\Category;
use App\Models\teams;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('team', 'category')->get();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $teams = Teams::all();
        $categories = categories::all();
        return view('projects.create', compact('teams', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'team_id' => 'required|exists:teams,id',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:Berjalan,Selesai,Draft',
        ]);
        Project::create($request->all());
        return redirect()->route('projects.index')->with('success', 'Project berhasil dibuat');
    }

    public function show(Project $project)
    {
        $project->load('team', 'category', 'proposals', 'progress');
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $teams = teams::all();
        $categories = categories::all();
        return view('projects.edit', compact('project', 'teams', 'categories'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'team_id' => 'required|exists:teams,id',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:Berjalan,Selesai,Draft',
        ]);
        $project->update($request->all());
        return redirect()->route('projects.show', $project->id)->with('success', 'Project berhasil diupdate');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project berhasil dihapus');
    }
}
