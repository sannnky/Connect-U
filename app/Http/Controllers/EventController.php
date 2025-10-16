<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with('category')->latest()->get();
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Event::class);
        $categories = Category::all();
        return view('events.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Event::class);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_at' => 'required|date',
            'end_at' => 'nullable|date|after_or_equal:start_at',
            'type' => 'required|in:Internal,Eksternal',
            'category_id' => 'nullable|exists:categories,id',
        ]);
        $validatedData['user_id'] = Auth::id();
        Event::create($validatedData);
        return redirect()->route('events.index')->with('success', 'Event berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $this->authorize('view', $event);
        $event->load('category');
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $this->authorize('update', $event);
        $categories = Category::all();
        return view('events.edit', compact('event', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        // PENAMBAHAN WAJIB: Memanggil authorize sebelum update
        $this->authorize('update', $event);

        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'start_at' => 'required|date',
            'end_at' => 'nullable|date|after_or_equal:start_at',
            'category_id' => 'nullable|exists:categories,id',
            'type' => 'required|in:Internal,Eksternal'
        ]);
        $event->update($validatedData);
        return redirect()->route('events.show', $event->id)->with('success', 'Event berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        // PENAMBAHAN WAJIB: Memanggil authorize sebelum delete
        $this->authorize('delete', $event);

        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event berhasil dihapus');
    }
}