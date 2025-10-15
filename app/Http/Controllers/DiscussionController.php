<?php

namespace App\Http\Controllers;


use App\Models\discussions;
use App\Models\teams;
use App\Models\User;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    public function index()
    {
        $discussions = discussions::with('team', 'user')->get();
        return view('discussions.index', compact('discussions'));
    }

    public function create()
    {
        $teams = teams::all();
        $users = User::all();
        return view('discussions.create', compact('teams', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id',
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string'
        ]);
        discussions::create($request->all());
        return redirect()->route('discussions.index')->with('success', 'Diskusi berhasil dibuat');
    }

    public function show(discussions $discussion)
    {
        $discussion->load('team', 'user');
        return view('discussions.show', compact('discussion'));
    }

    public function edit(Discussions $discussion)
    {
        $teams = teams::all();
        $users = User::all();
        return view('discussions.edit', compact('discussion', 'teams', 'users'));
    }

    public function update(Request $request, Discussions $discussion)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id',
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string'
        ]);
        $discussion->update($request->all());
        return redirect()->route('discussions.show', $discussion->id)->with('success', 'Diskusi berhasil diupdate');
    }

    public function destroy(Discussions $discussion)
    {
        $discussion->delete();
        return redirect()->route('discussions.index')->with('success', 'Diskusi berhasil dihapus');
    }
}
