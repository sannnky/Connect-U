<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\teams;
use App\Models\User;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function index()
    {
        $memberships = Membership::with('team', 'user')->get();
        return view('memberships.index', compact('memberships'));
    }

    public function create()
    {
        $teams = Team::all();
        $users = User::all();
        return view('memberships.create', compact('teams', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id',
            'user_id' => 'required|exists:users,id',
            'role' => 'nullable|string'
        ]);
        Membership::create($request->all());
        return redirect()->route('memberships.index')->with('success', 'Anggota berhasil ditambahkan ke tim');
    }

    public function show(Membership $membership)
    {
        $membership->load('team', 'user');
        return view('memberships.show', compact('membership'));
    }

    public function edit(Membership $membership)
    {
        $teams = Team::all();
        $users = User::all();
        return view('memberships.edit', compact('membership', 'teams', 'users'));
    }

    public function update(Request $request, Membership $membership)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id',
            'user_id' => 'required|exists:users,id',
            'role' => 'nullable|string'
        ]);
        $membership->update($request->all());
        return redirect()->route('memberships.show', $membership->id)->with('success','Data anggota tim berhasil diupdate');
    }

    public function destroy(Membership $membership)
    {
        $membership->delete();
        return redirect()->route('memberships.index')->with('success','Anggota berhasil dihapus dari tim');
    }
}
