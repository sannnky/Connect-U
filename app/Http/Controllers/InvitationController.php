<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\invitations;
use App\Models\Team;
use App\Models\teams;
use App\Models\User;
use Illuminate\Http\Request;

class InvitationController extends Controller
{
    public function index()
    {
        $invitations = Invitations::with('team','user')->get();
        return view('invitations.index', compact('invitations'));
    }

    public function create()
    {
        $teams = teams::all();
        $users = User::all();
        return view('invitations.create', compact('teams','users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id',
            'user_id' => 'required|exists:users,id',
            'status'  => 'in:pending,accepted,declined'
        ]);
        Invitations::create($request->all());
        return redirect()->route('invitations.index')->with('success','Undangan berhasil dikirim');
    }

    public function show(Invitations $invitation)
    {
        $invitation->load('team','user');
        return view('invitations.show', compact('invitation'));
    }

    public function edit(Invitations $invitation)
    {
        $teams = Teams::all();
        $users = User::all();
        return view('invitations.edit', compact('invitation', 'teams','users'));
    }

    public function update(Request $request, Invitations $invitation)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id',
            'user_id' => 'required|exists:users,id',
            'status'  => 'in:pending,accepted,declined'
        ]);
        $invitation->update($request->all());
        return redirect()->route('invitations.show', $invitation->id)->with('success','Status undangan diupdate');
    }

    public function destroy(invitations $invitation)
    {
        $invitation->delete();
        return redirect()->route('invitations.index')->with('success','Undangan berhasil dihapus');
    }
}
