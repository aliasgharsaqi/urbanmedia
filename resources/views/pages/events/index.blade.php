@extends('layouts.main')
@section('title', 'Events')

@section('content')
<div class="flex-1 p-6 bg-gray-50">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Client Events</h2>
        <a href="{{ route('events.create') }}" class="bg-gradient-to-r from-orange-400 to-orange-600 text-white px-6 py-2 rounded-lg font-semibold">Add Event</a>
    </div>
    <div class="overflow-x-auto bg-white rounded-xl shadow-lg border border-gray-200">
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="bg-gray-700 text-xs uppercase text-white">
                <tr>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Rate</th>
                    <th class="px-4 py-3">Heading</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $event->client_name }}</td>
                    <td class="px-4 py-3">{{ $event->email }}</td>
                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}</td>
                    <td class="px-4 py-3">${{ number_format($event->rate, 2) }}</td>
                    <td class="px-4 py-3">{{ $event->heading }}</td>
                    <td class="px-4 py-3 text-center space-x-2">
                        <a href="{{ route('events.edit', $event) }}" class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-700 hover:bg-blue-200 font-medium text-sm rounded-full">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('events.destroy', $event) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center gap-1 px-3 py-1 bg-red-100 text-red-700 hover:bg-red-200 font-medium text-sm rounded-full">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr class="border-t">
                     <td colspan="6" class="text-center py-10 text-gray-500">No events have been created yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection