<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Professional Signup</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/cards.css') }}" />

</head>
<body class="bg-gray-100 font-sans flex flex-col items-center justify-center min-h-screen py-10">

    <section class="advertisers-service-sec">
        <div class="section-header">
            <h2>Our <span>Services</span></h2>
            <p class="sec-icon"><i class="fas fa-gear"></i></p>
        </div>
        <div class="cards">
            <div class="card">
                <div class="icon-wrapper"><i class="fas fa-bullhorn"></i></div>
                <h3>Event Promotions</h3>
                <p>We promote your party across high-traffic channels including Instagram, WhatsApp, and our website.</p>
            </div>
            <div class="card">
                <div class="icon-wrapper"><i class="fas fa-camera-retro"></i></div>
                <h3>Content Creation & Reels</h3>
                <p>We produce viral Instagram Reels, posters, stories, and teaser videos to boost pre-event buzz.</p>
            </div>
            <div class="card">
                <div class="icon-wrapper"><i class="fas fa-ticket-alt"></i></div>
                <h3>Ticketing & Guestlist</h3>
                <p>We help with linking ticket platforms, increasing sales, and providing analytics support.</p>
            </div>
            <div class="card">
                <div class="icon-wrapper"><i class="fas fa-handshake"></i></div>
                <h3>Artist & Influencer Collabs</h3>
                <p>Looking for DJs, influencers, or photographers? We connect you with the right talent.</p>
            </div>
        </div>
    </section>

    <div class="w-full max-w-3xl p-8 bg-white/80 backdrop-blur-md rounded-2xl shadow-2xl border border-gray-200">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Create Account</h2>
        <form id="signupForm" method="POST" action="{{ route('register') }}">
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
                <label for="club" class="block text-sm font-medium text-gray-700 mb-1">Club</label>
                <input type="text" id="club" name="club" placeholder="Your Club Name" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500" value="{{ old('club') }}" />
                @error('club')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>
            
            <div class="mb-5">
                <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                <input type="text" id="location" name="location" placeholder="City, Country" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500" value="{{ old('location') }}" />
                @error('location')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="mb-5">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password" placeholder="Minimum 6 characters" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500" required />
                @error('password')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="mb-5">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Re-enter your password" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500" required />
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

            <div class="checkbox-container">
                <div class="checkbox-item">
                    <input type="checkbox" id="terms" name="terms" required />
                    <label for="terms">I agree to the <a href="#">Terms & Conditions</a></label>
                </div>
                <div class="checkbox-item">
                    <input type="checkbox" id="privacy" name="privacy" required />
                    <label for="privacy">I accept the <a href="#">Privacy Policy</a></label>
                </div>
                <div class="checkbox-item">
                    <input type="checkbox" id="newsletter" name="newsletter" />
                    <label for="newsletter"><a href="#">Subscribe</a> to newsletter</label>
                </div>
            </div>

            <button type="submit" class="w-full mt-6 bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-lg transition duration-200">
                Sign Up
            </button>

            <p class="text-center text-sm text-gray-600 mt-6">
                Already have an account?
                <a href="{{ route('login') }}" class="text-orange-600 hover:underline font-medium">Login</a>
            </p>
        </form>
    </div>
</body>
</html>