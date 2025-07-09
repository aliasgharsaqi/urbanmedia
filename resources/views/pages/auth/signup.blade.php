<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Professional Signup</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/assets/css/style.css" />
  </head>

  <body class="bg min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8 font-sans">
    <div class="w-full max-w-md bg-white/80 backdrop-blur-md rounded-2xl shadow-2xl border border-gray-200 p-6 sm:p-8">
      <h2 class="text-2xl sm:text-3xl font-bold text-center text-gray-800 mb-6">Create Account</h2>

      <form id="signupForm" method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-5">
          <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
          <input
            type="text"
            id="name"
            name="name"
            placeholder="John Doe"
            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500"
            required
            value="{{ old('name') }}"
          />
          @error('name')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
          @enderror
        </div>

        <!-- Email -->
        <div class="mb-5">
          <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
          <input
            type="email"
            id="email"
            name="email"
            placeholder="you@example.com"
            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500"
            required
            value="{{ old('email') }}"
          />
          @error('email')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
          @enderror
        </div>

        <!-- Password -->
        <div class="mb-5">
          <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
          <input
            type="password"
            id="password"
            name="password"
            placeholder="Minimum 6 characters"
            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500"
            required
          />
          @error('password')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
          @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-6">
          <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
          <input
            type="password"
            id="password_confirmation"
            name="password_confirmation"
            placeholder="Re-enter your password"
            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500"
            required
          />
        </div>

        <!-- Submit -->
        <button
          type="submit"
          class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-lg transition duration-200"
        >
          Sign Up
        </button>

        <!-- Login Redirect -->
        <p class="text-center text-sm text-gray-600 mt-6">
          Already have an account?
          <a href="{{ route('login') }}" class="text-orange-600 hover:underline font-medium">Login</a>
        </p>
      </form>
    </div>
  </body>
</html>
