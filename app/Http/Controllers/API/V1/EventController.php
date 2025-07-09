<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        try {
            $events = Event::latest()->get();
            return $events->isEmpty()
                ? $this->emptyResponse('No events found.')
                : $this->successResponse($events, 'Events retrieved successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('Could not retrieve events.', 500, $e);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'date' => ['required', 'date'],
            'time' => ['required'],
            'rate' => ['required', 'numeric'],
            'heading' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'entry' => ['required', 'string', 'max:255'],
            'others' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first());
        }

        try {
            $data = $validator->validated();
            $data['time'] = \Carbon\Carbon::parse($data['time'])->format('H:i:s');
            $event = Event::create($data);

            return $this->successResponse($event, 'Event created successfully.', 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Could not create event.', 500, $e);
        }
    }

    public function show(Event $event)
    {
        try {
            return $this->successResponse($event, 'Event retrieved successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('Could not retrieve event details.', 500, $e);
        }
    }

    public function update(Request $request, Event $event)
    {
        $validator = Validator::make($request->all(), [
            'client_name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => ['sometimes', 'required', 'string', 'email', 'max:255'],
            'date' => ['sometimes', 'required', 'date'],
            'time' => ['sometimes', 'required'],
            'rate' => ['sometimes', 'required', 'numeric'],
            'heading' => ['sometimes', 'required', 'string', 'max:255'],
            'address' => ['sometimes', 'required', 'string', 'max:255'],
            'entry' => ['sometimes', 'required', 'string', 'max:255'],
            'others' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first());
        }

        try {
            $data = $validator->validated();

            if (isset($data['time'])) {
                $data['time'] = \Carbon\Carbon::parse($data['time'])->format('H:i:s');
            }

            $event->update($data);
            return $this->successResponse($event, 'Event updated successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('Could not update event.', 500, $e);
        }
    }

    public function destroy(Event $event)
    {
        try {
            $event->delete();
            return $this->successResponse(null, 'Event deleted successfully.');
        } catch (\Exception $e) {
            return $this->errorResponse('Could not delete event.', 500, $e);
        }
    }
}