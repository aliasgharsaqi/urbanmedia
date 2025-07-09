@extends('layouts.main')
@section('title', 'Clubs')

@section('content')
<div class="w-full p-4 sm:p-6 bg-gray-50">
    <!-- Heading and Button -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Registered Clubs</h2>
        <a href="{{ route('clubs.create') }}" class="bg-gradient-to-r from-orange-400 to-orange-600 text-white px-5 py-2 sm:px-6 sm:py-2 rounded-lg font-semibold text-sm sm:text-base">Add Club</a>
    </div>

    <!-- Table container -->
    <div class="w-full overflow-x-auto bg-white rounded-xl shadow-lg border border-gray-200">
        <table class="min-w-full text-sm text-left text-gray-700 whitespace-nowrap">
            <thead class="bg text-xs uppercase text-black bg-orange-100">
                <tr>
                    <th class="px-4 sm:px-6 py-4">Full Name</th>
                    <th class="px-4 sm:px-6 py-4">Email</th>
                    <th class="px-4 sm:px-6 py-4">Club</th>
                    <th class="px-4 sm:px-6 py-4">Location</th>
                    <th class="px-4 sm:px-6 py-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clubs as $club)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 sm:px-6 py-4">{{ $club->name }}</td>
                    <td class="px-4 sm:px-6 py-4">{{ $club->email }}</td>
                    <td class="px-4 sm:px-6 py-4">{{ $club->club_name }}</td>
                    <td class="px-4 sm:px-6 py-4">{{ $club->location }}</td>
                    <td class="px-4 sm:px-6 py-4 text-center space-y-2 sm:space-x-2 sm:space-y-0">
                        <a href="{{ route('clubs.edit', $club) }}" class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-700 hover:bg-blue-200 font-medium text-xs sm:text-sm rounded-full">
                            <i class="fas fa-edit"></i> <span>Edit</span>
                        </a>
                        <form action="{{ route('clubs.destroy', $club) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center gap-1 px-3 py-1 bg-red-100 text-red-700 hover:bg-red-200 font-medium text-xs sm:text-sm rounded-full">
                                <i class="fas fa-trash-alt"></i> <span>Delete</span>
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
