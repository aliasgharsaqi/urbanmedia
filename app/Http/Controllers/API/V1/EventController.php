<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return EventResource::collection(Event::latest()->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'date' => ['required', 'date'],
            'time' => ['required'],
            'rate' => ['required', 'numeric'],
            'heading' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'entry' => ['required', 'string', 'max:255'],
        ]);

        $event = Event::create($request->all());

        return new EventResource($event);
    }

    public function show(Event $event)
    {
        return new EventResource($event);
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'client_name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => ['sometimes', 'required', 'string', 'email', 'max:255'],
            'date' => ['sometimes', 'required', 'date'],
            'time' => ['sometimes', 'required'],
            'rate' => ['sometimes', 'required', 'numeric'],
            'heading' => ['sometimes', 'required', 'string', 'max:255'],
            'address' => ['sometimes', 'required', 'string', 'max:255'],
            'entry' => ['sometimes', 'required', 'string', 'max:255'],
        ]);

        $event->update($request->all());

        return new EventResource($event);
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json(null, 204);
    }
}