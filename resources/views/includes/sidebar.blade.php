@include('includes.head')

<style>
  .sidebar-link.active {
    background-color: #FFEDD5;
    color: #EA580C;
    font-weight: 600;
  }
  .sidebar-link.active i {
    color: #EA580C;
  }
</style>

<div class="flex">
  <aside class="min-h-screen w-64 bg-white border-r border-gray-200">
    <div class="bg-gradient-to-br from-orange-400 to-orange-600 text-white p-6 rounded-b-2xl shadow-inner">
      <h2 class="text-2xl font-bold tracking-wide">Urban Media</h2>
    </div>

    <nav class="mt-8 px-4 space-y-2">
      
      <a href="{{ route('dashboard') }}" class="sidebar-link flex items-center w-full px-4 py-3 rounded-lg text-gray-700 hover:bg-orange-100 hover:text-orange-600 transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="fas fa-tachometer-alt mr-3 text-orange-500 group-hover:text-orange-600"></i>
        Dashboard
      </a>

      <a href="{{ route('clubs.index') }}" class="sidebar-link flex items-center w-full px-4 py-3 rounded-lg text-gray-700 hover:bg-orange-100 hover:text-orange-600 transition-all duration-200 group {{ request()->routeIs('clubs.*') ? 'active' : '' }}">
        <i class="fas fa-users mr-3 text-orange-500 group-hover:text-orange-600"></i>
        Clubs
      </a>

      <a href="{{ route('events.index') }}" class="sidebar-link flex items-center w-full px-4 py-3 rounded-lg text-gray-700 hover:bg-orange-100 hover:text-orange-600 transition-all duration-200 group {{ request()->routeIs('events.*') ? 'active' : '' }}">
        <i class="fas fa-calendar-check mr-3 text-orange-500 group-hover:text-orange-600"></i>
        Events
      </a>

    </nav>
  </aside>
</div>
