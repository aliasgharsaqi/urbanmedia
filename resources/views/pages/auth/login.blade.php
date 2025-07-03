<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Professional Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/assets/css/style.css" />
  </head>
  <body class="bg min-h-screen flex items-center justify-center font-sans">
    <div class="w-full max-w-md p-8 bg-white/80 backdrop-blur-md rounded-2xl shadow-2xl border border-gray-200">
      <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Login</h2>
      <form id="loginForm" novalidate>
        <div class="mb-5">
          <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
          <input
            type="email"
            id="email"
            name="email"
            placeholder="you@example.com"
            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
            required
          />
          <p class="mt-1 text-sm text-red-500 hidden" id="emailError">Please enter a valid email.</p>
        </div>

        <div class="mb-5">
          <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
          <input
            type="password"
            id="password"
            name="password"
            placeholder="••••••••"
            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
            required
            minlength="6"
          />
          <p class="mt-1 text-sm text-red-500 hidden" id="passwordError">Password must be at least 6 characters.</p>
        </div>

        <div class="flex items-center justify-between mb-6">
          <label class="flex items-center text-sm text-gray-600">
            <input type="checkbox" class="mr-2 rounded border-gray-300" />
            Remember me
          </label>
          <a href="#" class="text-sm text-orange-600 hover:underline">Forgot Password?</a>
        </div>

        <button
          type="submit"
          class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-lg transition duration-200"
        >
          Sign In
        </button>

        <p class="text-center text-sm text-gray-600 mt-6">
          Don't have an account?
          <a href="#" class="text-orange-600 hover:underline font-medium">Register</a>
        </p>
      </form>
    </div>

    <script>
      const form = document.getElementById("loginForm");
      const email = document.getElementById("email");
      const password = document.getElementById("password");
      const emailError = document.getElementById("emailError");
      const passwordError = document.getElementById("passwordError");

      form.addEventListener("submit", function (e) {
        let valid = true;

        // Email validation
        if (!email.checkValidity()) {
          emailError.classList.remove("hidden");
          valid = false;
        } else {
          emailError.classList.add("hidden");
        }

        // Password validation
        if (!password.checkValidity()) {
          passwordError.classList.remove("hidden");
          valid = false;
        } else {
          passwordError.classList.add("hidden");
        }

        if (!valid) {
          e.preventDefault(); // Prevent form submission
        }
      });
    </script>
  </body>
</html>
