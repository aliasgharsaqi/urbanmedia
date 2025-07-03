<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Professional Signup</title>
    <script src="https://cdn.tailwindcss.com"></script>
       <link rel="stylesheet" href="/assets/css/style.css" />
  </head>
  <body class="bg min-h-screen flex items-center justify-center font-sans">
    <div class="w-full max-w-md p-8 bg-white/80 backdrop-blur-md rounded-2xl shadow-2xl border border-gray-200">
      <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">Create Account</h2>
      <form id="signupForm" novalidate>
        <div class="mb-5">
          <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
          <input
            type="text"
            id="name"
            placeholder="John Doe"
            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500"
            required
          />
          <p class="mt-1 text-sm text-red-500 hidden" id="nameError">Name is required.</p>
        </div>

        <div class="mb-5">
          <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
          <input
            type="email"
            id="email"
            placeholder="you@example.com"
            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500"
            required
          />
          <p class="mt-1 text-sm text-red-500 hidden" id="emailError">Please enter a valid email.</p>
        </div>

        <div class="mb-5">
          <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
          <input
            type="password"
            id="password"
            placeholder="Minimum 6 characters"
            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500"
            required
          />
          <p class="mt-1 text-sm text-red-500 hidden" id="passwordError">Password must be at least 6 characters.</p>
        </div>

        <div class="mb-6">
          <label for="confirm" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
          <input
            type="password"
            id="confirm"
            placeholder="Re-enter your password"
            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500"
            required
          />
          <p class="mt-1 text-sm text-red-500 hidden" id="confirmError">Passwords do not match.</p>
        </div>

        <button
          type="submit"
          class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 rounded-lg transition duration-200"
        >
          Sign Up
        </button>

        <p class="text-center text-sm text-gray-600 mt-6">
          Already have an account?
          <a href="#" class="text-orange-600 hover:underline font-medium">Login</a>
        </p>
      </form>
    </div>

    <script>
      const form = document.getElementById("signupForm");
      const name = document.getElementById("name");
      const email = document.getElementById("email");
      const password = document.getElementById("password");
      const confirm = document.getElementById("confirm");

      const nameError = document.getElementById("nameError");
      const emailError = document.getElementById("emailError");
      const passwordError = document.getElementById("passwordError");
      const confirmError = document.getElementById("confirmError");

      form.addEventListener("submit", function (e) {
        let valid = true;

        if (name.value.trim() === "") {
          nameError.classList.remove("hidden");
          valid = false;
        } else {
          nameError.classList.add("hidden");
        }

        const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
        if (!email.value.match(emailPattern)) {
          emailError.classList.remove("hidden");
          valid = false;
        } else {
          emailError.classList.add("hidden");
        }

        if (password.value.length < 6) {
          passwordError.classList.remove("hidden");
          valid = false;
        } else {
          passwordError.classList.add("hidden");
        }

        if (password.value !== confirm.value || confirm.value === "") {
          confirmError.classList.remove("hidden");
          valid = false;
        } else {
          confirmError.classList.add("hidden");
        }

        if (!valid) {
          e.preventDefault();
        }
      });
    </script>
  </body>
</html>
