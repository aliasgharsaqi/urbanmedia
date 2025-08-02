@extends('layouts.main')
@section('title', 'Serivces')

@section('content')
<div class="w-full p-4 sm:p-6 bg-gray-50">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Registered Users</h2>
    </div>

    <div class="w-full overflow-x-auto bg-white rounded-xl shadow-lg border border-gray-200">
        <table class="min-w-full text-sm text-left text-gray-700 whitespace-nowrap">
            <thead class="text-xs uppercase text-black bg-orange-100">
                <tr>
                    <th class="px-6 py-4">#</th>
                    <th class="px-6 py-4">Full Name</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Club</th>
                    <th class="px-6 py-4">Location</th>
                    <th class="px-6 py-4">Services</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $key => $service)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-6 ">{{ ++$key }}</td>
                    <td class="px-6 ">{{ $service->name }}</td>
                    <td class="px-6 ">{{ $service->email }}</td>
                    <td class="px-6 ">{{ $service->club }}</td>
                    <td class="px-6 ">{{ $service->location }}</td>
                    <td class="px-6 ">
                        <ol class="list-decimal list-inside">
                            @foreach($service->services as $s)
                            <li class="text-sm text-gray-600">{{ $s }}</li>
                            @endforeach
                        </ol>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection