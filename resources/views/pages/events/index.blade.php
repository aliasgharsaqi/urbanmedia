@extends('layouts.main')
@section('title', 'Events')

@section('content')
<div class="w-full px-4 sm:px-6 lg:px-8 py-6 bg-gray-50">
    <!-- Heading and Button -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Client Events</h2>
        <a href="{{ route('events.create') }}" class="bg-gradient-to-r from-orange-400 to-orange-600 text-white px-5 py-2 sm:px-6 sm:py-2 rounded-lg font-semibold text-sm sm:text-base">Add Event</a>
    </div>

    <!-- Table Wrapper -->
    <div class="w-full overflow-x-auto bg-white rounded-xl shadow-lg border border-gray-200">
        <table class="min-w-full text-sm text-left text-gray-700 whitespace-nowrap">
            <thead class="bg-orange-100 text-xs uppercase text-black">
                <tr>
                    <th class="px-4 sm:px-6 py-3">Image</th>
                    <th class="px-4 sm:px-6 py-3">Heading/Title</th>
                    <th class="px-4 sm:px-6 py-3">Expected Guest</th>
                    <th class="px-4 sm:px-6 py-3">Date</th>
                    <th class="px-4 sm:px-6 py-3">Entry</th>
                    <th class="px-4 sm:px-6 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 sm:px-6 py-3">
                        @if ($event->event_image)
                        <img src="{{ Storage::url($event->event_image) }}" alt="Event Image" style="max-width: 100px; height: auto;">
                        @else
                        No Image
                        @endif
                    </td>
                    <td class="px-4 sm:px-6 py-3">{{ $event->heading ?? '' }}</td>
                    <td class="px-4 sm:px-6 py-3">{{ $event->expected_guest ?? '' }}</td>
                    <td class="px-4 sm:px-6 py-3">{{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}</td>
                    <td class="px-4 sm:px-6 py-3">{{ $event->entry ?? '' }}</td>
                    <td class="px-4 sm:px-6 py-3 text-center space-y-2 sm:space-x-2 sm:space-y-0">
                        <a href="{{ route('events.show', $event) }}" class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-700 hover:bg-blue-200 font-medium text-xs sm:text-sm rounded-full">
                            <i class="fas fa-eye"></i> <span></span>
                        </a>
                        <a href="{{ route('events.edit', $event) }}" class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-700 hover:bg-blue-200 font-medium text-xs sm:text-sm rounded-full">
                            <i class="fas fa-edit"></i> <span>Edit</span>
                        </a>
                        <form action="{{ route('events.destroy', $event) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center gap-1 px-3 py-1 bg-red-100 text-red-700 hover:bg-red-200 font-medium text-xs sm:text-sm rounded-full">
                                <i class="fas fa-trash-alt"></i> <span>Delete</span>
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