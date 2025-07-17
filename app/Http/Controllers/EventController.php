<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->role == 'Admin') {
            $events = Event::latest()->get();
        } else {
            $events = Event::where('user_id', $user->id)->latest()->get();
        }
        return view('pages.events.index', compact('events'));
    }

    public function create()
    {
        return view('pages.events.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in to create an event.');
        }

        $validatedData = $request->validate([
            'event_image'    => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
            'date'           => ['required', 'date'],
            'time'           => ['required', 'string'],
            'expected_guest' => ['required', 'string'],
            'heading'        => ['required', 'string', 'max:255'],
            'address'        => ['required', 'string'],
            'entry'          => ['required', 'string', 'max:255'],
            'desc'         => ['nullable', 'string'],
        ]);

        $imagePath = null;
        if ($request->hasFile('event_image')) {
            $imagePath = $request->file('event_image')->store('event_images', 'public');
        }

        $eventData = $validatedData;
        unset($eventData['event_image']);

        $eventData['event_image'] = $imagePath;
        $eventData['user_id'] = $user->id;

        Event::create($eventData);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    public function show(Event $event)
    {
        return view('pages.events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('pages.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $rules = [
            'event_image'    => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
            'date'           => ['required', 'date'],
            'time'           => ['required', 'string'],
            'expected_guest' => ['required', 'string'],
            'heading'        => ['required', 'string', 'max:255'],
            'address'        => ['required', 'string'],
            'entry'          => ['required', 'string', 'max:255'],
            'desc'           => ['nullable', 'string'],
        ];

        if (!$event->event_image && !$request->hasFile('event_image')) {
            $rules['event_image'] = ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'];
        }

        $validatedData = $request->validate($rules);

        $eventData = $validatedData;

        if ($request->hasFile('event_image')) {
            if ($event->event_image) {
                Storage::disk('public')->delete($event->event_image);
            }
            $eventData['event_image'] = $request->file('event_image')->store('event_images', 'public');
        } else {
            unset($eventData['event_image']);
        }

        $event->update($eventData);

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }
    
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
