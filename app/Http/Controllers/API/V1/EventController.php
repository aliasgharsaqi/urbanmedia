<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\EventResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the events.
     */
    public function index()
    {
        try {
            // Eager load relationships to prevent N+1 query issues
            $events = Event::with(['user', 'categories'])->latest()->get();
            dd($events->all());
            return $events->isEmpty()
                ? $this->emptyResponse('No events found.')
                : $this->successResponse(EventResource::collection($events), 'Events retrieved successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('Could not retrieve events.', 500, $e);
        }
    }

    /**
     * Store a newly created event in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
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

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first());
        }

        try {
            $data = $validator->validated();

            if ($request->hasFile('event_image')) {
                $data['event_image'] = $request->file('event_image')->store('event_images', 'public');
            }

            // Assuming API authentication is used (e.g., Sanctum)
            $data['user_id'] = auth()->id();
            
            $event = Event::create($data);
            $event->categories()->sync($request->categories);

            // Load relationships to include them in the API resource response
            $event->load('user', 'categories');

            return $this->successResponse(new EventResource($event), 'Event created successfully.', 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Could not create event.', 500, $e);
        }
    }

    /**
     * Display the specified event.
     */
    public function show(Event $event)
    {
        try {
            // Eager load relationships for the single event view
            $event->load('user', 'categories');
            return $this->successResponse(new EventResource($event), 'Event retrieved successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('Could not retrieve event details.', 500, $e);
        }
    }

    /**
     * Update the specified event in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validator = Validator::make($request->all(), [
            'event_image'       => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'heading'           => 'sometimes|required|string|max:255',
            'date'              => 'sometimes|required|date',
            'time'              => 'sometimes|required',
            'end_date'          => 'sometimes|required|date|after_or_equal:date',
            'end_time'          => 'sometimes|required',
            'occurrence_type'   => 'sometimes|required|string',
            'event_access_type' => 'sometimes|required|string|in:paid,rsvp,private',
            'expected_guest'    => 'sometimes|required|string',
            'entry'             => 'sometimes|required|string',
            'address'           => 'sometimes|required|string',
            'desc'              => 'nullable|string',
            'youtube_url'       => 'nullable|url',
            'special_details'   => 'nullable|string|max:255',
            'artist_performer'  => 'nullable|string|max:255',
            'categories'        => 'sometimes|required|array',
            'status'            => 'sometimes|required|string|in:draft,published',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first());
        }

        try {
            $data = $validator->validated();

            if ($request->hasFile('event_image')) {
                if ($event->event_image) {
                    Storage::disk('public')->delete($event->event_image);
                }
                $data['event_image'] = $request->file('event_image')->store('event_images', 'public');
            }

            $event->update($data);

            if ($request->has('categories')) {
                $event->categories()->sync($request->categories);
            }
            
            $event->load('user', 'categories');

            return $this->successResponse(new EventResource($event), 'Event updated successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('Could not update event.', 500, $e);
        }
    }

    /**
     * Remove the specified event from storage.
     */
    public function destroy(Event $event)
    {
        try {
            if ($event->event_image) {
                Storage::disk('public')->delete($event->event_image);
            }
            $event->delete();
            return $this->successResponse(null, 'Event deleted successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('Could not delete event.', 500, $e);
        }
    }
}
