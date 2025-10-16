<?php

namespace App\Http\Controllers;

use App\Models\events;
use App\Models\categories;
use App\Models\Category;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = events::with('category')->latest()->get();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        // Ambil data kategori untuk ditampilkan di form
        $categories = Category::all();
        return view('events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validasi data agar sesuai dengan struktur database
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_at' => 'required|date',
            'end_at' => 'nullable|date|after_or_equal:start_at',
            'type' => 'required|in:Internal,Eksternal',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        // Buat event hanya dengan data yang sudah tervalidasi
        events::create($validatedData);

        return redirect()->route('events.index')->with('success', 'Event berhasil dibuat!');
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

    public function show(events $event)
    {
        $event->load('category');
        return view('events.show', compact('event'));
    }

    public function edit(Events $event)
    {
        $categories = Category::all();
        return view('events.edit', compact('event', 'categories'));
    }
    public function destroy(Events $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event berhasil dihapus');
    }
}
