@extends('layouts.main')
@section('title', 'Add Event')

@section('content')
<div class="flex-1 p-6 bg-gray-50">
    <h2 class="text-2xl font-bold mb-4">Create Client Event</h2>
    <form action="{{ route('events.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                <input type="file" name="event_image" class="w-full border border-gray-300 rounded px-4 py-2" required />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Heading</label>
                <input type="text" name="heading" class="w-full border border-gray-300 rounded px-4 py-2" required />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                <input type="date" name="date" class="w-full border border-gray-300 rounded px-4 py-2" required />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Time</label>
                <input type="time" name="time" class="w-full border border-gray-300 rounded px-4 py-2" required />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Expected Guest</label>
                <input type="text" name="expected_guest" class="w-full border border-gray-300 rounded px-4 py-2" required />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Entry</label>
                <input type="text" name="entry" class="w-full border border-gray-300 rounded px-4 py-2" required />
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                <input type="text" name="address" class="w-full border border-gray-300 rounded px-4 py-2" required />
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Event Description</label>
                <textarea name="desc" rows="3" class="w-full border border-gray-300 rounded px-4 py-2"></textarea>
            </div>
        </div>
        <button type="submit" class="mt-6 bg-orange-500 text-white px-6 py-2 rounded hover:bg-orange-600">Submit</button>
    </form>
</div>
@endsection