@extends('layouts.main')
@section('title', 'Clubs')

@section('content')
    <div class="w-full p-6 bg-gray-50">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Registered Clubs</h2>
            <a href="{{ route('clubs.create') }}" class="bg-gradient-to-r from-orange-400 to-orange-600 text-white px-6 py-2 rounded-lg font-semibold">Add Club</a>
        </div>

        <div class="overflow-x-auto bg-white rounded-xl shadow-lg border border-gray-200">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="bg text-xs uppercase text-black">
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
                            <a href="{{ route('clubs.edit', $club) }}" class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-700 hover:bg-blue-200 font-medium text-sm rounded-full">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('clubs.destroy', $club) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-1 px-3 py-1 bg-red-100 text-red-700 hover:bg-red-200 font-medium text-sm rounded-full">
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
@endsection