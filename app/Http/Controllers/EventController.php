<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\Event;
use App\Models\Category;
use App\Models\events;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Events::with('category')->get();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        $categories = categories::all();
        return view('events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'start_at' => 'required|date',
            'end_at' => 'nullable|date|after_or_equal:start_at',
            'category_id' => 'nullable|exists:categories,id',
            'type' => 'required|in:Internal,Eksternal'
        ]);
        Events::create($request->all());
        return redirect()->route('events.index')->with('success', 'Event berhasil dibuat');
    }

    public function show(events $event)
    {
        $event->load('category');
        return view('events.show', compact('event'));
    }

    public function edit(Events $event)
    {
        $categories = categories::all();
        return view('events.edit', compact('event', 'categories'));
    }

    public function update(Request $request, events $event)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'start_at' => 'required|date',
            'end_at' => 'nullable|date|after_or_equal:start_at',
            'category_id' => 'nullable|exists:categories,id',
            'type' => 'required|in:Internal,Eksternal'
        ]);
        $event->update($request->all());
        return redirect()->route('events.show', $event->id)->with('success', 'Event berhasil diupdate');
    }

    public function destroy(Events $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event berhasil dihapus');
    }
}
