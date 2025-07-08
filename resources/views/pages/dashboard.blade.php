@extends('layouts.main')
@section('title', 'Dashboard')

@section('content')
<div class="flex-1 p-8 bg-gray-100">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-800 tracking-tight">Welcome, {{ auth()->user()->name ?? 'User' }}!</h1>
        <p class="text-lg text-gray-600 mt-1">Here's a quick look at your upcoming events.</p>
    </div>

    <div>
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Recent Events</h2>
        @if($events->isEmpty())
            <div class="bg-white p-8 rounded-xl shadow-lg text-center">
                <p class="text-gray-600">You have no upcoming events.</p>
                <a href="{{ route('events.create') }}" class="mt-4 inline-block bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-2 rounded-lg transition duration-200">
                    Create an Event
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($events as $event)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:-translate-y-1 transition-transform duration-300">
                    <div class="p-5">
                        <div class="flex items-center mb-3">
                            <div class="bg-orange-100 p-2 rounded-full">
                                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <p class="ml-3 text-sm font-medium text-gray-500">
                                {{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }} at {{ \Carbon\Carbon::parse($event->time)->format('g:i A') }}
                            </p>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 truncate">{{ $event->heading }}</h3>
                        <p class="text-sm text-gray-600 mt-1">Client: {{ $event->client_name }}</p>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <a href="{{ route('events.show', $event) }}" class="text-sm font-semibold text-orange-600 hover:text-orange-700">View Details &rarr;</a>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection