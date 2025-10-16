<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use App\Models\Team;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('team', 'category')->latest()->get();
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Project::class);
        $teams = Team::where('leader_id', auth()->id())->get(); // Hanya tim yang dimiliki user
        $categories = Category::all();
        return view('projects.create', compact('teams', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Project::class);
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

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $this->authorize('view', $project);
        $project->load('team', 'category', 'progress');
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $this->authorize('update', $project); // Pengecekan izin update
        $teams = Team::where('leader_id', auth()->id())->get();
        $categories = Category::all();
        return view('projects.edit', compact('project', 'teams', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        // PENAMBAHAN WAJIB: Memanggil authorize sebelum update
        $this->authorize('update', $project);

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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // PENAMBAHAN WAJIB: Memanggil authorize sebelum delete
        $this->authorize('delete', $project);

        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project berhasil dihapus');
    }
}