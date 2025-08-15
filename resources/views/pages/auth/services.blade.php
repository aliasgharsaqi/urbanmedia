<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Urban Night Media Landing Page</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #fff;
    }


    .header_faiz {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 10%;
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(5px);
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
      position: sticky;
      top: 0;
      z-index: 10;
    }

    .logo_faiz img {
      height: 40px;
    }

    .nav_faiz a {
      margin-left: 20px;
      text-decoration: none;
      color: #333;
      font-weight: bold;
      transition: color 0.3s;
    }

    .nav_faiz a:hover {
      color: #ff4d5a;
    }


    .hero_faiz {
    position: relative;
    background: url("{{ asset('assets/images/party.jpg') }}") top center / cover no-repeat;
    height: 450px;
    color: white;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 10%;
}

    .overlay_faiz {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.6);
      z-index: 1;
    }

    .hero-content_faiz {
      position: relative;
      z-index: 2;
      max-width: 500px;
    }

    .hero-content_faiz h1 {
      font-size: 28px;
      margin-bottom: 15px;
      font-weight: bold;
    }

    .hero-content_faiz p {
      font-size: 15px;
      line-height: 1.5;
    }

    .register-btn_faiz {
      display: inline-block;
      background: #f0612f;
      padding: 10px 18px;
      color: white;
      border-radius: 5px;
      text-decoration: none;
      margin-top: 15px;
      font-weight: bold;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      transition: 0.3s;
    }

    .register-btn_faiz:hover {
      background: #f0612f;
      transform: scale(1.05);
    }

    /* Login Box */
    .login-box_faiz {
      position: relative;
      z-index: 2;
      background: white;
      color: black;
      padding: 30px;
      border-radius: 8px;
      width: 300px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .login-box_faiz h3 {
      margin-top: 0;
      font-size: 16px;
      color: #333;
    }

    .login-box_faiz input {
      width: 100%;
      padding: 8px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .continue-btn_faiz {
      width: 100%;
      padding: 10px;
      background: #f0612f;
      color: white;
      border: none;
      font-weight: bold;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 8px;
      transition: 0.3s;
    }

    .continue-btn_faiz:hover {
      background: #f0612f;
      transform: scale(1.03);
    }

    .login-links_faiz {
      display: flex;
      justify-content: space-between;
      margin-top: 10px;
    }

    .login-links_faiz a {
      font-size: 13px;
      color: #555;
      text-decoration: none;
    }

    .login-links_faiz a:hover {
      text-decoration: underline;
    }

    /* Features Section */
    .features_faiz {
      padding: 40px 10%;
      text-align: center;
      background: #f9f9f9;
    }

    .features_faiz h2 {
      margin-bottom: 30px;
      color: #333;
    }

    .feature-grid_faiz {
      display: grid;
      gap: 20px;
    }

    .feature-grid-top_faiz {
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    }

    .feature-grid-bottom_faiz {
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }

    .feature-card_faiz {
      background: white;
      padding: 20px;
      border-radius: 8px;
      text-align: center;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
      transition: 0.3s;
    }

    .feature-card_faiz:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .feature-card_faiz i {
      font-size: 28px;
      color: #f0612f;
      margin-bottom: 10px;
    }

    .feature-card_faiz h4 {
      margin: 10px 0;
      font-size: 16px;
      color: #333;
    }

    .feature-card_faiz p {
      font-size: 14px;
      color: #555;
    }

    @media (max-width: 768px) {
      .hero_faiz {
        flex-direction: column;
        height: auto;
        padding: 40px 20px;
        text-align: center;
      }

      .login-box_faiz {
        margin-top: 20px;
      }

      .nav_faiz {
        display: flex;
        gap: 15px;
      }
    }
  </style>
</head>

<body>



  <!-- Hero Section -->
  <section class="hero_faiz">
    <div class="overlay_faiz"></div>
    <div class="hero-content_faiz">
      <h1>
        Get Ready To Promote Your Event & Sell Tickets Online Smarter, Faster,
        Better.
      </h1>
      <p>
        Urban Night Media has everything you need to make your event successful.
        Advanced Step by Step Event Creation. Sell and track, Promote through
        all possible channels.
      </p>
      <a href="{{ route('service.request.create') }}" class="register-btn_faiz">Grab Your Service</a>
    </div>
    <div class="login-box_faiz">
      <h3>Login To Get Started. Now!</h3>
      <form id="loginForm" method="POST" action="{{ route('login') }}">
        @csrf
        <input type="email" id="email" name="email" placeholder="you@example.com" required value="{{ old('email') }}" />
        @error('email')
        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror

        <input type="password" id="password" name="password" placeholder="••••••••" required />
        @error('password')
        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror

        <button type="submit" class="continue-btn_faiz">CONTINUE</button>
      </form>
      <div class="login-links_faiz">
        <a href="{{ route('register') }}">Register</a>
        <a href="{{ route('password.request') }}">Forgot Password?</a>
      </div>
    </div>
  </section>

  <!-- Features Section -->
  <section class="features_faiz">
    <h2>WITH Urban Night Media YOU CAN</h2>
    <div class="feature-grid_faiz feature-grid-top_faiz">
      <div class="feature-card_faiz">
        <i class="fa-solid fa-ticket"></i>
        <h4>Create Events & Sell Tickets</h4>
        <p>
          Create events instantly and get best tools to help you sell tickets,
          accept bookings, collect registrations.
        </p>
      </div>
      <div class="feature-card_faiz">
        <i class="fa-solid fa-bullhorn"></i>
        <h4>Complete Marketing Suite</h4>
        <p>
          Reach out to customers via our advanced marketing tools. Send SMS,
          Emails, and more.
        </p>
      </div>
      <div class="feature-card_faiz">
        <i class="fa-solid fa-bullseye"></i>
        <h4>Promote Events Online</h4>
        <p>
          Do extensive digital marketing with our premium plans. Be visible in
          Google, social media and more.
        </p>
      </div>
    </div>

    <div class="feature-grid_faiz feature-grid-bottom_faiz" style="margin-top: 30px">
      <div class="feature-card_faiz">
        <i class="fa-solid fa-chart-line"></i>
        <h4>SEO Optimized</h4>
        <p>
          Rank #1 on Google! Get more traffic organically with our optimized
          event pages.
        </p>
      </div>
      <div class="feature-card_faiz">
        <i class="fa-solid fa-sack-dollar"></i>
        <h4>Get Your Money Fast</h4>
        <p>
          We provide instant payout options for your events. Never worry about
          cash flow again.
        </p>
      </div>
      <div class="feature-card_faiz">
        <i class="fa-solid fa-microchip"></i>
        <h4>Highly Advanced Technology</h4>
        <p>
          Use our advanced tools for bookings and analytics. The best event
          tech is here.
        </p>
      </div>
    </div>
    <div class="feature-grid_faiz feature-grid-bottom_faiz" style="margin-top: 30px">
      <div class="feature-card_faiz">
        <i class="fa-solid fa-chart-line"></i>
        <h4>SEO Optimized</h4>
        <p>
          Rank #1 on Google! Get more traffic organically with our optimized
          event pages.
        </p>
      </div>
      <div class="feature-card_faiz">
        <i class="fa-solid fa-sack-dollar"></i>
        <h4>Get Your Money Fast</h4>
        <p>
          We provide instant payout options for your events. Never worry about
          cash flow again.
        </p>
      </div>
      <div class="feature-card_faiz">
        <i class="fa-solid fa-microchip"></i>
        <h4>Highly Advanced Technology</h4>
        <p>
          Use our advanced tools for bookings and analytics. The best event
          tech is here.
        </p>
      </div>
    </div>
  </section>
</body>

</html>