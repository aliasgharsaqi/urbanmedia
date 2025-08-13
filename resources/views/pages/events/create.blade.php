@extends('layouts.main')
@section('title', 'Add Event')

@section('content')
<div class="flex-1 p-6 bg-gray-50">
    <h2 class="text-2xl font-bold mb-4">Create Client Event</h2>
    <form action="{{ route('events.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cover Image*</label>
                <input type="file" name="event_image" class="w-full border border-gray-300 rounded px-4 py-2" required />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Heading*</label>
                <input type="text" name="heading" value="{{ old('heading') }}" class="w-full border border-gray-300 rounded px-4 py-2" required />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Start Date*</label>
                <input type="date" name="date" value="{{ old('date') }}" class="w-full border border-gray-300 rounded px-4 py-2" required />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Start Time*</label>
                <input type="time" name="time" value="{{ old('time') }}" class="w-full border border-gray-300 rounded px-4 py-2" required />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">End Date*</label>
                <input type="date" name="end_date" value="{{ old('end_date') }}" class="w-full border border-gray-300 rounded px-4 py-2" required />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">End Time*</label>
                <input type="time" name="end_time" value="{{ old('end_time') }}" class="w-full border border-gray-300 rounded px-4 py-2" required />
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Occurrence*</label>
                <select name="occurrence_type" class="w-full border border-gray-300 rounded px-4 py-2" required>
                    <option value="once" @selected(old('occurrence_type') == 'once')>Once</option>
                    <option value="multiple" @selected(old('occurrence_type') == 'multiple')>Multiple</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Event Access Type*</label>
                <select name="event_access_type" class="w-full border border-gray-300 rounded px-4 py-2" required>
                    <option value="paid" @selected(old('event_access_type') == 'paid')>Paid Event</option>
                    <option value="rsvp" @selected(old('event_access_type') == 'rsvp')>RSVP/Guestlist</option>
                    <option value="private" @selected(old('event_access_type') == 'private')>Private/Request</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Expected Guest*</label>
                <input type="text" name="expected_guest" value="{{ old('expected_guest') }}" class="w-full border border-gray-300 rounded px-4 py-2" required />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Entry*</label>
                <input type="text" name="entry" value="{{ old('entry') }}" class="w-full border border-gray-300 rounded px-4 py-2" required />
            </div>
            
            <!-- Status Dropdown (New) -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status*</label>
                <select name="status" class="w-full border border-gray-300 rounded px-4 py-2" required>
                    <option value="draft" @selected(old('status', 'draft') == 'draft')>Draft</option>
                    <option value="published" @selected(old('status') == 'published')>Published</option>
                </select>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Artist/Performer (Optional)</label>
                <input type="text" name="artist_performer" value="{{ old('artist_performer') }}" class="w-full border border-gray-300 rounded px-4 py-2" placeholder="Artist Name (If Any)" />
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Event Type* (Hold Ctrl/Cmd to select multiple)</label>
                <select name="categories[]" class="w-full border border-gray-300 rounded px-4 py-2 h-32" multiple required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Special Entry Details (Optional)</label>
                <input type="text" name="special_details" value="{{ old('special_details') }}" class="w-full border border-gray-300 rounded px-4 py-2" />
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Address*</label>
                <input type="text" name="address" value="{{ old('address') }}" class="w-full border border-gray-300 rounded px-4 py-2" required />
            </div>
            
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">YouTube Video Link (Optional)</label>
                <input type="url" name="youtube_url" value="{{ old('youtube_url') }}" class="w-full border border-gray-300 rounded px-4 py-2" placeholder="https://youtube.com/watch?v=..." />
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Event Description (Optional)</label>
                <textarea name="desc" rows="4" class="w-full border border-gray-300 rounded px-4 py-2">{{ old('desc') }}</textarea>
            </div>
        </div>
        <button type="submit" class="mt-6 bg-orange-500 text-white px-6 py-2 rounded hover:bg-orange-600">Submit</button>
    </form>
</div>
@endsection
