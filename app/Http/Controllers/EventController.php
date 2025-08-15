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
     */
    public function index()
    {
        $user = auth()->user();
        // Admins see all events, other users only see their own.
        if ($user->role == 'Admin') {
            $events = Event::with('categories', 'user')->latest()->get();
        } else {
            $events = Event::where('user_id', $user->id)->with('categories')->latest()->get();
        }
        return view('pages.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('pages.events.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            // --- REQUIRED FIELDS based on migrations ---
            'heading'           => 'required|string|max:255',
            'date'              => 'required|date',
            'time'              => 'required',
            'expected_guest'    => 'required|string',
            'address'           => 'required|string',
            'entry'             => 'required|string',
            'event_image'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // FIX: Made required as per create_events_table migration.
            'categories'        => 'required|array',

            // --- OPTIONAL (NULLABLE) FIELDS based on migrations ---
            'end_date'          => 'nullable|date|after_or_equal:date', // FIX: Changed to nullable to match migration.
            'end_time'          => 'nullable', // FIX: Changed to nullable to match migration.
            'venue'             => 'nullable|string|max:255',
            'city'              => 'nullable|string|max:255',
            'price'             => 'nullable|numeric',
            'desc'              => 'nullable|string',
            'youtube_url'       => 'nullable|url',
            'special_details'   => 'nullable|string|max:255',
            'artist_performer'  => 'nullable|string|max:255',
            'terms_and_conditions' => 'nullable|string', // ADDED: This field was missing from validation.

            // --- FIELDS WITH DEFAULTS (but good to validate) ---
            'occurrence_type'   => 'sometimes|string',
            'event_access_type' => 'sometimes|string', // ADDED: This field was missing from validation.
            'status'            => 'sometimes|string|in:draft,published',
        ]);

        if ($request->hasFile('event_image')) {
            $validatedData['event_image'] = $request->file('event_image')->store('event_images', 'public');
        }

        $validatedData['user_id'] = Auth::id();
        
        $event = Event::create($validatedData);

        // Sync categories if they are provided.
        if ($request->has('categories')) {
            $event->categories()->sync($request->categories);
        }

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $event->load('user', 'categories');
        return view('pages.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        // Ensure only the event owner or an admin can edit.
        if (auth()->id() !== $event->user_id && auth()->user()->role !== 'Admin') {
            abort(403, 'UNAUTHORIZED ACTION');
        }

        $categories = Category::orderBy('name')->get();
        $event->load('categories'); // Eager load categories for the event.
        return view('pages.events.edit', compact('event', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        // Ensure only the event owner or an admin can update.
        if (auth()->id() !== $event->user_id && auth()->user()->role !== 'Admin') {
            abort(403, 'UNAUTHORIZED ACTION');
        }

        $validatedData = $request->validate([
            // --- REQUIRED FIELDS ---
            'heading'           => 'required|string|max:255',
            'date'              => 'required|date',
            'time'              => 'required',
            'expected_guest'    => 'required|string',
            'address'           => 'required|string',
            'entry'             => 'required|string',
            'categories'        => 'required|array',

            // --- OPTIONAL (NULLABLE) FIELDS ---
            'event_image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Correctly nullable for updates.
            'end_date'          => 'nullable|date|after_or_equal:date', // FIX: Changed to nullable.
            'end_time'          => 'nullable', // FIX: Changed to nullable.
            'venue'             => 'nullable|string|max:255',
            'city'              => 'nullable|string|max:255',
            'price'             => 'nullable|numeric',
            'desc'              => 'nullable|string',
            'youtube_url'       => 'nullable|url',
            'special_details'   => 'nullable|string|max:255',
            'artist_performer'  => 'nullable|string|max:255',
            'terms_and_conditions' => 'nullable|string', // ADDED: This field was missing.

            // --- FIELDS WITH DEFAULTS ---
            'occurrence_type'   => 'sometimes|string',
            'event_access_type' => 'sometimes|string', // ADDED: This field was missing.
            'status'            => 'sometimes|string|in:draft,published',
        ]);

        if ($request->hasFile('event_image')) {
            // Delete old image if it exists
            if ($event->event_image) {
                Storage::disk('public')->delete($event->event_image);
            }
            // Store the new image
            $validatedData['event_image'] = $request->file('event_image')->store('event_images', 'public');
        }

        $event->update($validatedData);

        // Sync categories, ensuring it handles cases where no categories are selected.
        $event->categories()->sync($request->categories ?? []);

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        // Ensure only the event owner or an admin can delete.
        if (auth()->id() !== $event->user_id && auth()->user()->role !== 'Admin') {
            abort(403, 'UNAUTHORIZED ACTION');
        }

        // Delete the associated image from storage.
        if ($event->event_image) {
            Storage::disk('public')->delete($event->event_image);
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
