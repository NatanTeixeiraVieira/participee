<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(){
        $events = Event::all();
        return view('events.index', compact('events'));
    }

    public function create() {
        return view('events.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'neighborhood' => 'required|string|max:255',
            'zipcode' => 'required|string|max:20',
            'number' => 'required|string|max:20',
            'complement' => 'nullable|string|max:255',
            'date' => 'required|date',
        ]);

        $validated['created_by'] = 1;
        Event::create($validated);
        return redirect()->route('events.index')->with('success', 'Event criada com sucesso!');
    }

    public function show(Event $event) {
        return view('events.show', compact('event'));
    }

    public function edit(Event $event) {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event) {
       $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'neighborhood' => 'required|string|max:255',
            'zipcode' => 'required|string|max:20',
            'number' => 'required|string|max:20',
            'complement' => 'nullable|string|max:255',
            'date' => 'required|date',
        ]);

        $event->update($validated);
        return redirect()->route('events.index')->with('success', 'Event atualizada!');
    }

    public function destroy(Event $event) {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event excluída!');
    }
}
