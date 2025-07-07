@extends('layouts.main')
@section('title', 'Edit Event')

@section('content')
<div class="flex-1 p-6 bg-gray-50">
    <h2 class="text-2xl font-bold mb-4">Edit Client Event</h2>
    <form action="{{ route('events.update', $event) }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Client Name</label>
                <input type="text" name="client_name" value="{{ old('client_name', $event->client_name) }}" class="w-full border border-gray-300 rounded px-4 py-2" required />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $event->email) }}" class="w-full border border-gray-300 rounded px-4 py-2" required />
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
                <label class="block text-sm font-medium text-gray-700 mb-1">Rate</label>
                <input type="number" name="rate" step="0.01" value="{{ old('rate', $event->rate) }}" class="w-full border border-gray-300 rounded px-4 py-2" required />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Heading</label>
                <input type="text" name="heading" value="{{ old('heading', $event->heading) }}" class="w-full border border-gray-300 rounded px-4 py-2" required />
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                <input type="text" name="address" value="{{ old('address', $event->address) }}" class="w-full border border-gray-300 rounded px-4 py-2" required />
            </div>
             <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Entry</label>
                <input type="text" name="entry" value="{{ old('entry', $event->entry) }}" class="w-full border border-gray-300 rounded px-4 py-2" required />
            </div>
             <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Other Details</label>
                <textarea name="others" rows="3" class="w-full border border-gray-300 rounded px-4 py-2">{{ old('others', $event->others) }}</textarea>
            </div>
        </div>
        <button type="submit" class="mt-6 bg-orange-500 text-white px-6 py-2 rounded hover:bg-orange-600">Update</button>
    </form>
</div>
@endsection