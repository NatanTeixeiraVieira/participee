<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(){
        $events = Event::with('creator')->get();
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
    ], [
        'name.required' => 'O campo nome é obrigatório.',
        'description.required' => 'A descrição é obrigatória.',
        'state.required' => 'O Estado é obrigatório.',
        'city.required' => 'A cidade é obrigatória.',
        'neighborhood.required' => 'O bairro é obrigatório.',
        'zipcode.required' => 'O CEP é obrigatório.',
        'number.required' => 'O número é obrigatório.',
        'date.required' => 'A data do evento é obrigatória.',
        'date.date' => 'A data deve estar em um formato válido.',
    ]);

    $validated['created_by'] = auth()->id();
    Event::create($validated);

    return redirect()->route('events.index')->with('success', 'Evento criado com sucesso!');
}

    public function show(Event $event) {
        $event->load('creator');
        return view('events.show', compact('event'));
    }

    public function myEvents() {
        $events = Event::where('created_by', auth()->id())->get();

        return view('events.my-events', compact('events'));
    }

    public function edit(Event $event) {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event) {
        if ($event->created_by !== auth()->id()) {
            return redirect()->route('events.index')->with('error', 'Você não tem permissão para editar este evento.');
        }
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
        ], [
            'name.required' => 'O campo nome é obrigatório.',
            'description.required' => 'A descrição é obrigatória.',
            'state.required' => 'O Estado é obrigatório.',
            'city.required' => 'A cidade é obrigatória.',
            'neighborhood.required' => 'O bairro é obrigatório.',
            'zipcode.required' => 'O CEP é obrigatório.',
            'number.required' => 'O número é obrigatório.',
            'date.required' => 'A data do evento é obrigatória.',
            'date.date' => 'A data deve estar em um formato válido.',
        ]);


        $event->update($validated);
        return redirect()->route('events.index')->with('success', 'Event atualizada!');
    }

    public function destroy(Event $event) {
        if ($event->created_by !== auth()->id()) {
            return redirect()->route('events.index')->with('error', 'Você não tem permissão para excluir este evento.');
        }
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event excluída!');
    }
}
