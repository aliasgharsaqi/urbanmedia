@extends('layouts.main')
@section('title', 'Event Details')

@section('content')
<div class="w-full px-4 sm:px-6 lg:px-8 py-6 bg-gray-50">
    <!-- Header with Back Button -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">
            {{ $event->heading }}
        </h2>
        <a href="{{ route('events.index') }}" class="bg-gray-200 text-gray-700 px-5 py-2 rounded-lg font-semibold text-sm hover:bg-gray-300">
            &larr; Back to All Events
        </a>
    </div>

    <!-- Main Content Wrapper -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Left Column: Image and Description -->
            <div class="md:col-span-1">
                @if ($event->event_image)
                    <img src="{{ Storage::url($event->event_image) }}" alt="Event Image" class="w-full h-auto rounded-lg shadow-md mb-4">
                @else
                    <div class="w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500">
                        No Image
                    </div>
                @endif
                <h3 class="text-lg font-bold text-gray-800 border-b pb-2 mb-2">Description</h3>
                <p class="text-gray-600 text-sm">{{ $event->desc ?? 'No description provided.' }}</p>
            </div>

            <!-- Right Column: Event Details -->
            <div class="md:col-span-2">
                <h3 class="text-xl font-bold text-gray-800 border-b pb-2 mb-4">Event Details</h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 text-sm">
                    <!-- Detail Item -->
                    <div>
                        <p class="font-semibold text-gray-500">Status</p>
                        <p class="text-gray-800 capitalize">{{ $event->status }}</p>
                    </div>
                    
                    <!-- Detail Item -->
                    <div>
                        <p class="font-semibold text-gray-500">Event Access</p>
                        <p class="text-gray-800 capitalize">{{ $event->event_access_type }}</p>
                    </div>

                    <!-- Detail Item -->
                    <div>
                        <p class="font-semibold text-gray-500">Start</p>
                        <p class="text-gray-800">{{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }} at {{ \Carbon\Carbon::parse($event->time)->format('h:i A') }}</p>
                    </div>

                    <!-- Detail Item -->
                    <div>
                        <p class="font-semibold text-gray-500">End</p>
                        <p class="text-gray-800">{{ \Carbon\Carbon::parse($event->end_date)->format('M d, Y') }} at {{ \Carbon\Carbon::parse($event->end_time)->format('h:i A') }}</p>
                    </div>

                    <!-- Detail Item -->
                    <div>
                        <p class="font-semibold text-gray-500">Entry Fee</p>
                        <p class="text-gray-800">{{ $event->entry }}</p>
                    </div>

                    <!-- Detail Item -->
                    <div>
                        <p class="font-semibold text-gray-500">Expected Guests</p>
                        <p class="text-gray-800">{{ $event->expected_guest }}</p>
                    </div>
                    
                    <!-- Detail Item -->
                    <div>
                        <p class="font-semibold text-gray-500">Artist/Performer</p>
                        <p class="text-gray-800">{{ $event->artist_performer ?? 'N/A' }}</p>
                    </div>

                    <!-- Detail Item -->
                    <div>
                        <p class="font-semibold text-gray-500">Event Types</p>
                        <div class="flex flex-wrap gap-2 mt-1">
                            @forelse($event->categories as $category)
                                <span class="bg-orange-100 text-orange-700 text-xs font-semibold px-2.5 py-0.5 rounded-full">{{ $category->name }}</span>
                            @empty
                                <span class="text-gray-500">Not specified</span>
                            @endforelse
                        </div>
                    </div>

                    <!-- Detail Item (Full Width) -->
                    <div class="sm:col-span-2">
                        <p class="font-semibold text-gray-500">Address</p>
                        <p class="text-gray-800">{{ $event->address }}</p>
                    </div>

                    <!-- Detail Item (Full Width) -->
                    <div class="sm:col-span-2">
                        <p class="font-semibold text-gray-500">Special Details</p>
                        <p class="text-gray-800">{{ $event->special_details ?? 'None' }}</p>
                    </div>
                    
                    <!-- Detail Item (Full Width) -->
                    @if($event->youtube_url)
                    <div class="sm:col-span-2">
                        <p class="font-semibold text-gray-500">Video Link</p>
                        <a href="{{ $event->youtube_url }}" target="_blank" class="text-blue-600 hover:underline break-all">{{ $event->youtube_url }}</a>
                    </div>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 pt-4 border-t flex items-center gap-4">
                    <a href="{{ route('events.edit', $event) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-500 text-white font-semibold text-xs rounded-lg hover:bg-blue-600">
                        <i class="fas fa-edit"></i>
                        <span>Edit Event</span>
                    </a>
                    <form action="{{ route('events.destroy', $event) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-red-500 text-white font-semibold text-xs rounded-lg hover:bg-red-600">
                            <i class="fas fa-trash-alt"></i>
                            <span>Delete Event</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
