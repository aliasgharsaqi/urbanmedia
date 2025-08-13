<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        // Eager load categories to prevent N+1 query issues
        if ($user->role == 'Admin') {
            $events = Event::with('categories', 'user')->latest()->get();
        } else {
            $events = Event::where('user_id', $user->id)->with('categories')->latest()->get();
        }
        return view('pages.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('pages.events.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'event_image'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'heading'           => 'required|string|max:255',
            'date'              => 'required|date',
            'time'              => 'required',
            'end_date'          => 'required|date|after_or_equal:date',
            'end_time'          => 'required',
            'occurrence_type'   => 'required|string',
            'event_access_type' => 'required|string|in:paid,rsvp,private',
            'expected_guest'    => 'required|string',
            'entry'             => 'required|string',
            'address'           => 'required|string',
            'desc'              => 'nullable|string',
            'youtube_url'       => 'nullable|url',
            'special_details'   => 'nullable|string|max:255',
            'artist_performer'  => 'nullable|string|max:255',
            'categories'        => 'required|array',
            'status'            => 'required|string|in:draft,published',
        ]);

        if ($request->hasFile('event_image')) {
            $validatedData['event_image'] = $request->file('event_image')->store('event_images', 'public');
        }

        $validatedData['user_id'] = Auth::id();
        
        $event = Event::create($validatedData);

        // Attach the selected categories
        $event->categories()->sync($request->categories);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $event->load('user', 'categories');
        return view('pages.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        // Authorization check
        if (auth()->id() !== $event->user_id && auth()->user()->role !== 'Admin') {
            abort(403, 'UNAUTHORIZED ACTION');
        }

        $categories = Category::orderBy('name')->get();
        $event->load('categories');
        return view('pages.events.edit', compact('event', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        // Authorization check
        if (auth()->id() !== $event->user_id && auth()->user()->role !== 'Admin') {
            abort(403, 'UNAUTHORIZED ACTION');
        }

        $validatedData = $request->validate([
            'event_image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'heading'           => 'required|string|max:255',
            'date'              => 'required|date',
            'time'              => 'required',
            'end_date'          => 'required|date|after_or_equal:date',
            'end_time'          => 'required',
            'occurrence_type'   => 'required|string',
            'event_access_type' => 'required|string|in:paid,rsvp,private',
            'expected_guest'    => 'required|string',
            'entry'             => 'required|string',
            'address'           => 'required|string',
            'desc'              => 'nullable|string',
            'youtube_url'       => 'nullable|url',
            'special_details'   => 'nullable|string|max:255',
            'artist_performer'  => 'nullable|string|max:255',
            'categories'        => 'required|array',
            'status'            => 'required|string|in:draft,published',
        ]);

        if ($request->hasFile('event_image')) {
            // Delete the old image if it exists
            if ($event->event_image) {
                Storage::disk('public')->delete($event->event_image);
            }
            $validatedData['event_image'] = $request->file('event_image')->store('event_images', 'public');
        }

        $event->update($validatedData);

        // Sync the categories relationship
        $event->categories()->sync($request->categories);

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        // Authorization check
        if (auth()->id() !== $event->user_id && auth()->user()->role !== 'Admin') {
            abort(403, 'UNAUTHORIZED ACTION');
        }

        // Delete the associated image from storage if it exists
        if ($event->event_image) {
            Storage::disk('public')->delete($event->event_image);
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
