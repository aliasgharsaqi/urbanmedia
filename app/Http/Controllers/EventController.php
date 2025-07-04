<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'rate' => 'required|numeric',
            'heading' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'entry' => 'required|string|max:255',
        ]);

        Event::create($request->all());

        return redirect()->route('dashboard')->with('success', 'Client created successfully!');
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'rate' => 'required|numeric',
            'heading' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'entry' => 'required|string|max:255',
        ]);

        $event->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Client updated successfully!');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('dashboard')->with('success', 'Client deleted successfully!');
    }
}
