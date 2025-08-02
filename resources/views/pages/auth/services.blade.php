<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Our Services</title>

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

    <div class="buttons-container">
        <a href="{{ route('service.request.create') }}" class="service-btn">Grab Your Service</a>
        <a href="{{route('login')}}" class="service-btn">Post Your Event</a>
    </div>

<!-- Floating WhatsApp Button-->
 <style>
@keyframes pulsing {
    to {
        box-shadow: 0 0 0 30px rgba(66, 219, 135, 0);
    }
}
</style>
<div style="position: fixed; bottom: 30px; right: 30px; width: 100px; height: 100px; display: flex; flex-direction: column; align-items: center; justify-content: center; z-index: 1000;">
    <a target="_blank" href="https://wa.me/923000000000" style="text-decoration: none;">
        <div style=" background-color: #42db87; color: #fff; width: 60px; height: 60px; font-size: 30px; border-radius: 50%; text-align: center; display: flex; align-items: center; justify-content: center; box-shadow: 0 0 0 0 #42db87; animation: pulsing 1.25s infinite cubic-bezier(0.66, 0, 0, 1); transition: all 300ms ease-in-out;">
            <i class="fab fa-whatsapp"></i>
        </div>
    </a>
    <p style="margin-top: 8px; color: #707070; font-size: 13px;">Talk to us?</p>
</div>



</body>

</html>