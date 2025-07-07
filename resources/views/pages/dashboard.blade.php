@extends('layouts.main')
@section('title', 'Dashboard')

@section('content')
<div class="flex-1 p-6 bg-gray-50">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">
        Welcome, {{ auth()->user()->name ?? 'User' }}!
    </h1>
    <div class="bg-white p-8 rounded-xl shadow-lg">
        <p class="text-gray-700 text-lg">
            Please use the navigation menu on the left to manage the application.
        </p>
    </div>
</div>
@endsection
