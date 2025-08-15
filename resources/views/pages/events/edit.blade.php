@extends('layouts.main')
@section('title', 'Edit Event')

@section('content')
<div class="flex-1 p-6 bg-gray-50">
    <h2 class="text-2xl font-bold mb-4">Edit Client Event</h2>

    <form action="{{ route('events.update', $event) }}" method="POST" class="bg-white shadow-md rounded-lg p-6" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">There were some problems with your input.</span>
                <ul class="mt-3 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <div class="md:col-span-2">
                <label for="heading" class="block text-sm font-medium text-gray-700 mb-1">Heading <span class="text-red-500">*</span></label>
                <input type="text" id="heading" name="heading" value="{{ old('heading', $event->heading) }}" class="w-full border @error('heading') border-red-500 @else border-gray-300 @enderror rounded px-4 py-2" />
                @error('heading')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="venue" class="block text-sm font-medium text-gray-700 mb-1">Venue/Location</label>
                <input type="text" id="venue" name="venue" value="{{ old('venue', $event->venue) }}" class="w-full border border-gray-300 rounded px-4 py-2" />
                 @error('venue')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                <input type="text" id="city" name="city" value="{{ old('city', $event->city) }}" class="w-full border border-gray-300 rounded px-4 py-2" />
                 @error('city')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Street Address <span class="text-red-500">*</span></label>
                <input type="text" id="address" name="address" value="{{ old('address', $event->address) }}" class="w-full border @error('address') border-red-500 @else border-gray-300 @enderror rounded px-4 py-2" />
                @error('address')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                <input type="number" id="price" name="price" value="{{ old('price', $event->price) }}" class="w-full border @error('price') border-red-500 @else border-gray-300 @enderror rounded px-4 py-2" step="0.01" placeholder="e.g., 500.00" />
                @error('price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Start Date <span class="text-red-500">*</span></label>
                <input type="date" id="date" name="date" value="{{ old('date', $event->date) }}" class="w-full border @error('date') border-red-500 @else border-gray-300 @enderror rounded px-4 py-2" />
                @error('date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="time" class="block text-sm font-medium text-gray-700 mb-1">Start Time <span class="text-red-500">*</span></label>
                <input type="time" id="time" name="time" value="{{ old('time', $event->time) }}" class="w-full border @error('time') border-red-500 @else border-gray-300 @enderror rounded px-4 py-2" />
                @error('time')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                <input type="date" id="end_date" name="end_date" value="{{ old('end_date', $event->end_date) }}" class="w-full border @error('end_date') border-red-500 @else border-gray-300 @enderror rounded px-4 py-2" />
                @error('end_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="end_time" class="block text-sm font-medium text-gray-700 mb-1">End Time</label>
                <input type="time" id="end_time" name="end_time" value="{{ old('end_time', $event->end_time) }}" class="w-full border @error('end_time') border-red-500 @else border-gray-300 @enderror rounded px-4 py-2" />
                @error('end_time')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="occurrence_type" class="block text-sm font-medium text-gray-700 mb-1">Occurrence</label>
                <select id="occurrence_type" name="occurrence_type" class="w-full border border-gray-300 rounded px-4 py-2">
                    <option value="once" @selected(old('occurrence_type', $event->occurrence_type) == 'once')>Once</option>
                    <option value="multiple" @selected(old('occurrence_type', $event->occurrence_type) == 'multiple')>Multiple</option>
                </select>
            </div>
            
            <div>
                <label for="event_access_type" class="block text-sm font-medium text-gray-700 mb-1">Event Access Type</label>
                <select id="event_access_type" name="event_access_type" class="w-full border border-gray-300 rounded px-4 py-2">
                    <option value="paid" @selected(old('event_access_type', $event->event_access_type) == 'paid')>Paid Event</option>
                    <option value="rsvp" @selected(old('event_access_type', $event->event_access_type) == 'rsvp')>RSVP/Guestlist</option>
                    <option value="private" @selected(old('event_access_type', $event->event_access_type) == 'private')>Private/Request</option>
                </select>
            </div>

            <div class="md:col-span-2 relative">
                <label class="block text-sm font-medium text-gray-700 mb-1">Event Type <span class="text-red-500">*</span></label>
                @error('categories')
                    <p class="text-red-500 text-xs mb-1">{{ $message }}</p>
                @enderror
                <div x-data="{ open: false }" class="w-full">
                    <button @click="open = !open" type="button" class="w-full border @error('categories') border-red-500 @else border-gray-300 @enderror rounded px-4 py-2 text-left bg-white flex justify-between items-center">
                        <span class="text-gray-700">Select Categories...</span>
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-y-auto">
                        @foreach($categories as $category)
                            <label class="flex items-center px-4 py-2 hover:bg-gray-100 cursor-pointer">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="form-checkbox h-4 w-4 text-orange-600 border-gray-300 rounded" @checked(in_array($category->id, $event->categories->pluck('id')->toArray()))>
                                <span class="ml-3 text-sm text-gray-700">{{ $category->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="md:col-span-2">
                <label for="artist_performer" class="block text-sm font-medium text-gray-700 mb-1">Artist/Performer</label>
                <input type="text" id="artist_performer" name="artist_performer" value="{{ old('artist_performer', $event->artist_performer) }}" class="w-full border border-gray-300 rounded px-4 py-2" placeholder="Artist Name (If Any)" />
                @error('artist_performer')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="expected_guest" class="block text-sm font-medium text-gray-700 mb-1">Expected Guest <span class="text-red-500">*</span></label>
                <input type="text" id="expected_guest" name="expected_guest" value="{{ old('expected_guest', $event->expected_guest) }}" class="w-full border @error('expected_guest') border-red-500 @else border-gray-300 @enderror rounded px-4 py-2" />
                @error('expected_guest')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="entry" class="block text-sm font-medium text-gray-700 mb-1">Entry <span class="text-red-500">*</span></label>
                <input type="text" id="entry" name="entry" value="{{ old('entry', $event->entry) }}" class="w-full border @error('entry') border-red-500 @else border-gray-300 @enderror rounded px-4 py-2" />
                @error('entry')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select id="status" name="status" class="w-full border border-gray-300 rounded px-4 py-2">
                    <option value="draft" @selected(old('status', $event->status) == 'draft')>Draft</option>
                    <option value="published" @selected(old('status', $event->status) == 'published')>Published</option>
                </select>
            </div>

            <div class="md:col-span-2">
                <label for="special_details" class="block text-sm font-medium text-gray-700 mb-1">Special Entry Details</label>
                <input type="text" id="special_details" name="special_details" value="{{ old('special_details', $event->special_details) }}" class="w-full border border-gray-300 rounded px-4 py-2" />
                @error('special_details')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="md:col-span-2">
                <label for="event_image" class="block text-sm font-medium text-gray-700 mb-1">Cover Image</label>
                <input type="file" id="event_image" name="event_image" class="w-full border @error('event_image') border-red-500 @else border-gray-300 @enderror rounded px-4 py-2" />
                @if ($event->event_image)
                    <div class="mt-2"><img src="{{ Storage::url($event->event_image) }}" alt="Current Image" class="w-32 h-auto rounded"></div>
                @endif
                @error('event_image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="md:col-span-2">
                <label for="youtube_url" class="block text-sm font-medium text-gray-700 mb-1">YouTube Video Link</label>
                <input type="url" id="youtube_url" name="youtube_url" value="{{ old('youtube_url', $event->youtube_url) }}" class="w-full border @error('youtube_url') border-red-500 @else border-gray-300 @enderror rounded px-4 py-2" placeholder="https://youtube.com/watch?v=..." />
                @error('youtube_url')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="desc" class="block text-sm font-medium text-gray-700 mb-1">Event Description</label>
                <textarea id="desc" name="desc" rows="4" class="w-full border border-gray-300 rounded px-4 py-2">{{ old('desc', $event->desc) }}</textarea>
                @error('desc')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="terms_editor" class="block text-sm font-medium text-gray-700 mb-1">Terms & Conditions</label>
                <textarea name="terms_and_conditions" id="terms_editor" rows="6" class="w-full border border-gray-300 rounded px-4 py-2">{{ old('terms_and_conditions', $event->terms_and_conditions) }}</textarea>
                @error('terms_and_conditions')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <button type="submit" class="mt-6 bg-orange-500 text-white px-6 py-2 rounded hover:bg-orange-600">Update Event</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="https://cdn.ckeditor.com/4.25.1-lts/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('terms_editor');
</script>
@endsection
