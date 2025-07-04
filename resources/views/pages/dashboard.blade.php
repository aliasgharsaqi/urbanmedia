@extends('layouts.main')
@section('title', 'Dashboard')
@include('includes.head')
<link rel="stylesheet" href="/assets/css/style.css" />
@section('content')
<div class="flex-1 p-6 bg-gray-50">

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="mb-8">
        <button onclick="showTab('club')" class="px-4 py-2 bg-orange-500 text-white rounded-lg">Clubs</button>
        <button onclick="showTab('client')" class="px-4 py-2 bg-blue-500 text-white rounded-lg">Clients</button>
    </div>

    <!-- Club Section -->
    <div id="club" class="tab">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">Club Registration</h2>

        <form action="{{ route('clubs.store') }}" method="POST" class="bg-white shadow-xl rounded-2xl p-8 mb-10 border border-gray-200">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                    <input type="text" name="name" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-orange-400 focus:outline-none" required />
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-orange-400 focus:outline-none" required />
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                    <input type="password" name="password" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-orange-400 focus:outline-none" required />
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-orange-400 focus:outline-none" required />
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Club Name</label>
                    <input type="text" name="club_name" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-orange-400 focus:outline-none" required />
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Location</label>
                    <input type="text" name="location" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-orange-400 focus:outline-none" required />
                </div>
            </div>

            <div class="mt-6 text-right">
                <button type="submit" class="bg-gradient-to-r from-orange-400 to-orange-600 text-white px-6 py-2 rounded-lg font-semibold shadow-md hover:shadow-lg hover:from-orange-500 hover:to-orange-700 transition duration-200">
                    Submit
                </button>
            </div>
        </form>

        <h2 class="text-2xl font-bold mb-4 text-gray-800">Registered Clubs</h2>
        <div class="overflow-x-auto bg-white rounded-xl shadow-lg border border-gray-200">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="bg text-xs uppercase text-white">
                    <tr>
                        <th class="px-6 py-4">Full Name</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">Club</th>
                        <th class="px-6 py-4">Location</th>
                        <th class="px-6 py-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clubs as $club)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $club->name }}</td>
                        <td class="px-6 py-4">{{ $club->email }}</td>
                        <td class="px-6 py-4">{{ $club->club_name }}</td>
                        <td class="px-6 py-4">{{ $club->location }}</td>
                        <td class="px-6 py-4 text-center space-x-2">
                            <button class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-700 hover:bg-blue-200 font-medium text-sm rounded-full shadow-sm transition">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <form action="{{ route('clubs.destroy', $club) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this club?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1 px-3 py-1 bg-red-100 text-red-700 hover:bg-red-200 font-medium text-sm rounded-full shadow-sm transition">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

   <!-- Client Section -->
    <div id="client" class="tab hidden">
      <h2 class="text-2xl font-bold mb-4 text-bg">Client Form</h2>

      <form action="{{ route('events.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6 mb-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Client Name</label>
            <input type="text" name="client_name" class="w-full border border-gray-300 rounded px-4 py-2 focus:ring focus:ring-blue-300" required />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" class="w-full border border-gray-300 rounded px-4 py-2 focus:ring focus:ring-blue-300" required />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
            <input type="date" name="date" class="w-full border border-gray-300 rounded px-4 py-2 focus:ring focus:ring-blue-300" required />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Time</label>
            <input type="time" name="time" class="w-full border border-gray-300 rounded px-4 py-2 focus:ring focus:ring-blue-300" required />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Rate</label>
            <input type="number" name="rate" placeholder="Enter rate" class="w-full border border-gray-300 rounded px-4 py-2 focus:ring focus:ring-blue-300" required />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Heading</label>
            <input type="text" name="heading" placeholder="Enter heading" class="w-full border border-gray-300 rounded px-4 py-2 focus:ring focus:ring-blue-300" required />
          </div>
          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
            <input type="text" name="address" placeholder="Enter address" class="w-full border border-gray-300 rounded px-4 py-2 focus:ring focus:ring-blue-300" required />
          </div>
          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Others</label>
            <input type="text" name="others" placeholder="Other details" class="w-full border border-gray-300 rounded px-4 py-2 focus:ring focus:ring-blue-300" />
          </div>
          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 mb-1">Entry</label>
            <input type="text" name="entry" placeholder="Entry by..." class="w-full border border-gray-300 rounded px-4 py-2 focus:ring focus:ring-blue-300" required />
          </div>
        </div>

        <button type="submit" class="mt-6 bg text-white px-6 py-2 rounded hover:bg-blue-700 transition">
          Submit
        </button>
      </form>

      <h2 class="text-2xl font-bold mb-2">Client Table</h2>
      <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg text-sm">
          <thead>
            <tr class="bg text-left text-white">
              <th class="px-4 py-2 border-b">Name</th>
              <th class="px-4 py-2 border-b">Email</th>
              <th class="px-4 py-2 border-b">Date</th>
              <th class="px-4 py-2 border-b">Time</th>
              <th class="px-4 py-2 border-b">Rate</th>
              <th class="px-4 py-2 border-b">Heading</th>
              <th class="px-4 py-2 border-b">Address</th>
              <th class="px-4 py-2 border-b">Others</th>
              <th class="px-4 py-2 border-b">Entry</th>
              <th class="px-4 py-2 border-b">Actions</th>
            </tr>
          </thead>
          <tbody>
             @foreach($events as $event)
            <tr>
              <td class="px-4 py-2 border-b">{{ $event->client_name }}</td>
              <td class="px-4 py-2 border-b">{{ $event->email }}</td>
              <td class="px-4 py-2 border-b">{{ $event->date }}</td>
              <td class="px-4 py-2 border-b">{{ $event->time }}</td>
              <td class="px-4 py-2 border-b">${{ $event->rate }}</td>
              <td class="px-4 py-2 border-b">{{ $event->heading }}</td>
              <td class="px-4 py-2 border-b">{{ $event->address }}</td>
              <td class="px-4 py-2 border-b">{{ $event->others }}</td>
              <td class="px-4 py-2 border-b">{{ $event->entry }}</td>
              <td class="px-4 py-2 border-b text-center">
                <button class="text-blue-600 hover:underline mr-2"><i class="fas fa-edit"></i></button>
                 <form action="{{ route('events.destroy', $event) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this event?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline"><i class="fas fa-trash-alt"></i></button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
</div>
@stop

@pushOnce('scripts')
<script>
function showTab(tab) {
    document.querySelectorAll('.tab').forEach(div => div.classList.add('hidden'));
    document.getElementById(tab).classList.remove('hidden');
}

// Default tab
showTab('club');
</script>
@endPushOnce
