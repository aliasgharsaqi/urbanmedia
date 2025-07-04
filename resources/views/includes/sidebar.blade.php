@include('includes.head')
<div class="flex">
  <!-- Sidebar -->
  <aside class="min-h-screen w-64 bg-white border-r border-gray-200">
    <!-- Header -->
    <div class="bg-gradient-to-br from-orange-400 to-orange-600 text-white p-6 rounded-b-2xl shadow-inner">
      <h2 class="text-2xl font-bold tracking-wide">Dashboard</h2>
    </div>

    <!-- Navigation Links -->
    <nav class="mt-8 px-4 space-y-2">
      <button
        onclick="showTab('club')"
        class="flex items-center w-full px-4 py-3 rounded-lg text-gray-700 font-semibold hover:bg-orange-100 hover:text-orange-600 transition-all duration-200 group"
      >
        <i class="fas fa-users mr-3 text-orange-500 group-hover:text-orange-600"></i>
        Club
      </button>

      <button
        onclick="showTab('client')"
        class="flex items-center w-full px-4 py-3 rounded-lg text-gray-700 font-semibold hover:bg-orange-100 hover:text-orange-600 transition-all duration-200 group"
      >
        <i class="fas fa-calendar-check mr-3 text-orange-500 group-hover:text-orange-600"></i>
        Event
      </button>
    </nav>
  </aside>
</div>
