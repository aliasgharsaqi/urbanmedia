@extends('layouts.main')
@section('title', 'Edit Event')

@section('content')
<div class="flex-1 p-6 bg-gray-50">
    <h2 class="text-2xl font-bold mb-4">Edit Client Event</h2>
    <form action="{{ route('events.update', $event) }}" method="POST" class="bg-white shadow-md rounded-lg p-6" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                <input type="file" name="event_image" class="w-full border border-gray-300 rounded px-4 py-2" />
                @if ($event->event_image)
                <div class="mt-2">
                    <p class="text-sm text-gray-600">Current Image:</p>
                    <img src="{{ Storage::url($event->event_image) }}" alt="Current Event Image" style="max-width: 150px; height: auto; border-radius: 4px; margin-top: 5px;">
                </div>
                @endif
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Heading</label>
                <input type="text" name="heading" value="{{ old('heading', $event->heading) }}" class="w-full border border-gray-300 rounded px-4 py-2" required />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                <input type="date" name="date" value="{{ old('date', $event->date) }}" class="w-full border border-gray-300 rounded px-4 py-2" required />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Time</label>
                <input type="time" name="time" value="{{ old('time', $event->time) }}" class="w-full border border-gray-300 rounded px-4 py-2" required />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Expected Guest</label>
                <input type="text" name="expected_guest" value="{{ old('expected_guest', $event->expected_guest) }}" class="w-full border border-gray-300 rounded px-4 py-2" required />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Entry</label>
                <input type="text" name="entry" value="{{ old('entry', $event->entry) }}" class="w-full border border-gray-300 rounded px-4 py-2" required />
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                <input type="text" name="address" value="{{ old('address', $event->address) }}" class="w-full border border-gray-300 rounded px-4 py-2" required />
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Event Description</label>
                <textarea name="desc" rows="3" class="w-full border border-gray-300 rounded px-4 py-2">{{ old('desc', $event->desc) }}</textarea>
            </div>
        </div>
        <button type="submit" class="mt-6 bg-orange-500 text-white px-6 py-2 rounded hover:bg-orange-600">Update</button>
    </form>
</div>
@endsection