<?php

namespace App\Http\Controllers;

use App\Models\announcement;
use App\Models\announcements;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = announcements::orderBy('start_at','desc')->get();
        return view('announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('announcements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'start_at' => 'required|date',
            'end_at' => 'nullable|date|after_or_equal:start_at',
            'target' => 'nullable|string'
        ]);
        announcements::create($request->all());
        return redirect()->route('announcements.index')->with('success','Pengumuman berhasil ditambahkan');
    }

    public function show(announcements $announcement)
    {
        return view('announcements.show', compact('announcement'));
    }

    public function edit(announcements $announcement)
    {
        return view('announcements.edit', compact('announcement'));
    }

    public function update(Request $request, announcements $announcement)
    {
        $request->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'start_at' => 'required|date',
            'end_at' => 'nullable|date|after_or_equal:start_at',
            'target' => 'nullable|string'
        ]);
        $announcement->update($request->all());
        return redirect()->route('announcements.show',$announcement->id)->with('success','Pengumuman berhasil diupdate');
    }

    public function destroy(announcements $announcement)
    {
        $announcement->delete();
        return redirect()->route('announcements.index')->with('success','Pengumuman berhasil dihapus');
    }
}
