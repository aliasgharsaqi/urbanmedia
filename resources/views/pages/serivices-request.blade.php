<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Grab Our Services</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/cards.css') }}" />

</head>

<body class="bg-gray-100 font-sans flex flex-col items-center justify-center min-h-screen py-10">
    <div class="w-full max-w-3xl p-8 bg-white/80 backdrop-blur-md rounded-2xl shadow-2xl border border-gray-200">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Request Our Services 🚀</h2>
        @if (session('success'))
            <div class="mb-4 p-4 text-sm font-medium text-green-800 bg-green-100 rounded-lg" role="alert">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="mb-4 p-4 text-sm font-medium text-red-800 bg-red-100 rounded-lg" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <form id="serviceRequestForm" method="POST" action="{{ route('service.request.store') }}">
            @csrf
            <div class="mb-5">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <input type="text" id="name" name="name" placeholder="John Doe" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500" required value="{{ old('name') }}" />
                @error('name')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="mb-5">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" id="email" name="email" placeholder="you@example.com" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500" required value="{{ old('email') }}" />
                @error('email')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="mb-5">
                <label for="club" class="block text-sm font-medium text-gray-700 mb-1">Club / Organization Name</label>
                <input type="text" id="club" name="club" placeholder="Your Club Name" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500" value="{{ old('club') }}" />
                @error('club')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="mb-5">
                <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                <input type="text" id="location" name="location" placeholder="City, Country" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500" value="{{ old('location') }}" />
                @error('location')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Services of Interest</label>
                <div class="space-y-3">
                    <div class="flex items-center">
                        <input id="service_promo" name="services[]" type="checkbox" value="Event Promotions" class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded">
                        <label for="service_promo" class="ml-3 block text-sm font-medium text-gray-700">Event Promotions</label>
                    </div>
                    <div class="flex items-center">
                        <input id="service_content" name="services[]" type="checkbox" value="Content Creation & Reels" class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded">
                        <label for="service_content" class="ml-3 block text-sm font-medium text-gray-700"> Content Creation & Reels</label>
                    </div>
                    <div class="flex items-center">
                        <input id="service_ticketing" name="services[]" type="checkbox" value="Ticketing & Guestlist Management" class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded">
                        <label for="service_ticketing" class="ml-3 block text-sm font-medium text-gray-700">Ticketing & Guestlist Management</label>
                    </div>
                    <div class="flex items-center">
                        <input id="service_collabs" name="services[]" type="checkbox" value="Artist & Influencer Collaborations" class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded">
                        <label for="service_collabs" class="ml-3 block text-sm font-medium text-gray-700">Artist & Influencer Collaborations</label>
                    </div>
                    <div class="flex items-center">
                        <input id="service_strategy" name="services[]" type="checkbox" value="Event Strategy & Planning" class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded">
                        <label for="service_strategy" class="ml-3 block text-sm font-medium text-gray-700">Event Strategy & Planning</label>
                    </div>
                </div>
                @error('services')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>

            <button id="openModalBtn" type="button" class="w-full mt-6 bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-lg transition duration-200">
                Submit Service Request
            </button>
        </form>
    </div>

    <div id="confirmationModal" class="fixed inset-0 bg-gray-900 bg-opacity-60 items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-sm mx-auto mt-20">
            <h3 class="text-xl font-bold text-center text-gray-800 mb-4">Confirm Submission</h3>
            <p class="text-center text-gray-600 mb-6">Are you sure you want to submit this service request?</p>
            <div class="flex justify-center gap-4">
                <button id="cancelBtn" type="button" class="px-6 py-2 rounded-lg text-gray-700 bg-gray-200 hover:bg-gray-300 font-semibold">
                    Cancel
                </button>
                <button id="confirmBtn" type="button" class="px-6 py-2 rounded-lg text-white bg-orange-500 hover:bg-orange-600 font-semibold">
                    Yes, Submit
                </button>
            </div>
        </div>
    </div>
<script>
    const serviceForm = document.getElementById('serviceRequestForm');
    const modal = document.getElementById('confirmationModal');
    const openModalBtn = document.getElementById('openModalBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const confirmBtn = document.getElementById('confirmBtn');

    openModalBtn.addEventListener('click', () => {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    });

    const closeModal = () => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    };

    cancelBtn.addEventListener('click', closeModal);
    confirmBtn.addEventListener('click', () => {
        // When user confirms, submit the form
        serviceForm.submit();
    });
</script>
</body>

</html>