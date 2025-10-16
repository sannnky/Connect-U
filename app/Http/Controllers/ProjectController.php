<?php

namespace App\Http\Controllers;

// Menggunakan nama model yang sudah diperbaiki
use App\Models\Category;
use App\Models\Project;
use App\Models\Team;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('team', 'category')->latest()->get();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $teams = Team::all();
        $categories = Category::all();
        return view('projects.create', compact('teams', 'categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'team_id' => 'required|exists:teams,id',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:Berjalan,Selesai,Draft',
        ]);
        Project::create($validatedData);
        return redirect()->route('projects.index')->with('success', 'Project berhasil dibuat');
    }

    public function show(Project $project)
    {
        $project->load('team', 'category', 'progress');
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $teams = Team::all();
        $categories = Category::all();
        return view('projects.edit', compact('project', 'teams', 'categories'));
    }

    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'team_id' => 'required|exists:teams,id',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:Berjalan,Selesai,Draft',
        ]);
        $project->update($validatedData);
        return redirect()->route('projects.show', $project->id)->with('success', 'Project berhasil diupdate');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project berhasil dihapus');
    }
}

