<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::with('leader', 'members')->get();
        return view('teams.index', compact('teams'));
    }

    public function create()
    {
        $users = User::all();
        return view('teams.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'leader_id' => 'nullable|exists:users,id',
        ]);
        $team = Team::create($request->all());
        if ($request->leader_id) {
            $team->members()->attach($request->leader_id, ['role' => 'Ketua']);
        }
        return redirect()->route('teams.index')->with('success', 'Tim berhasil dibuat');
    }

    public function show(Team $team)
    {
        $team->load('leader', 'members', 'projects');
        return view('teams.show', compact('team'));
    }

    public function edit(Team $team)
    {
        $users = User::all();
        return view('teams.edit', compact('team', 'users'));
    }

    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'leader_id' => 'nullable|exists:users,id',
        ]);
        $team->update($request->all());
        return redirect()->route('teams.show', $team->id)->with('success', 'Tim berhasil diupdate');
    }

    public function destroy(Team $team)
    {
        $team->delete();
        return redirect()->route('teams.index')->with('success', 'Tim berhasil dihapus');
    }
}
