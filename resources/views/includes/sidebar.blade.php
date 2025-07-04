@include('includes.head')

<!-- Optional: Add styles if using plain CSS -->
<style>
  .active {
    background-color: #FFEDD5; /* Tailwind's orange-100 */
    color: #EA580C !important; /* Tailwind's orange-600 */
  }
</style>

<div class="flex">
  <!-- Sidebar -->
  <aside class="min-h-screen w-64 bg-white border-r border-gray-200">
    <!-- Header -->
    <div class="bg-gradient-to-br from-orange-400 to-orange-600 text-white p-6 rounded-b-2xl shadow-inner">
      <h2 class="text-2xl font-bold tracking-wide">Dashboard</h2>
    </div>

    <!-- Navigation Links -->
    <nav class="mt-8 px-4 space-y-2">
      <!-- Club Button - Active by default -->
      <button
        onclick="activateTab(this, 'club')"
        class="flex items-center w-full px-4 py-3 rounded-lg text-gray-700 font-semibold hover:bg-orange-100 hover:text-orange-600 transition-all duration-200 group active"
      >
        <i class="fas fa-users mr-3 text-orange-500 group-hover:text-orange-600"></i>
        Club
      </button>

      <!-- Event Button -->
      <button
        onclick="activateTab(this, 'client')"
        class="flex items-center w-full px-4 py-3 rounded-lg text-gray-700 font-semibold hover:bg-orange-100 hover:text-orange-600 transition-all duration-200 group"
      >
        <i class="fas fa-calendar-check mr-3 text-orange-500 group-hover:text-orange-600"></i>
        Event
      </button>
    </nav>
  </aside>
</div>

<!-- Script to handle active button toggle -->
<script>
  function activateTab(button, tabName) {
    // Remove 'active' class from all buttons
    document.querySelectorAll("nav button").forEach(btn => {
      btn.classList.remove("active");
    });

    // Add 'active' class to the clicked button
    button.classList.add("active");

    // Optional: Load tab content
    showTab(tabName);
  }

  // Optional: Define showTab logic if needed
  function showTab(tabName) {
    console.log("Switched to tab:", tabName);
    // Add your tab show/hide logic here
  }
</script>
