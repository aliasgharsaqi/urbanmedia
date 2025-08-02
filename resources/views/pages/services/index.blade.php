@extends('layouts.main')
@section('title', 'Serivces')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/cards.css') }}" />
<style>
    .buttons-container {
        display: flex;
        justify-content: center;
        gap: 20px;
        /* Space between buttons */
        margin-top: 40px;
        /* Space above the buttons */
        flex-wrap: wrap;
    }

    .service-btn {
        display: inline-block;
        background-color: #ffffff;
        /* Match card background */
        color: #333;
        padding: 15px 30px;
        border-radius: 10px;
        /* Match card border-radius */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        /* Match card shadow */
        text-decoration: none;
        font-weight: 600;
        font-size: 1rem;
        text-align: center;
        border: 1px solid #eee;
        /* Subtle border */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        /* Match card transition */
    }

    .service-btn:hover {
        transform: translateY(-5px);
        /* Lift effect on hover */
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        /* Enhanced shadow on hover */
    }
</style>

<div class="w-full p-4 sm:p-6 bg-gray-50">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Our Serivces</h2>
    </div>


    <div class="w-full overflow-x-auto bg-white rounded-xl shadow-lg border border-gray-200">
        @if (session('success'))
        <div class="mb-4 p-4 text-sm font-medium text-green-800 bg-green-100 rounded-lg" role="alert">
            {{ session('success') }}
        </div>
        @elseif (session('error'))
        <div class="mb-4 p-4 text-sm font-medium text-red-800 bg-red-100 rounded-lg" role="alert">
            {{ session('error') }}
        </div>
        @endif
        <div class="bg-gray-100 font-sans flex flex-col items-center justify-center min-h-screen py-10">
            <section class="advertisers-service-sec">
                <div class="section-header">
                    <h2>Our <span>Services</span></h2>
                    <p class="sec-icon"><i class="fas fa-gear"></i></p>
                </div>

                <div class="buttons-container">
                    <a href="{{ route('admin.create.services') }}" class="service-btn">Grab Your Service</a>
                </div>

                <div class="cards mt-5">
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
        </div>
    </div>
</div>
@endsection