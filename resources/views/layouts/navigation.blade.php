<div
  x-show="sidebarOpen"
  x-transition:enter="transition transform duration-300"
  x-transition:enter-start="-translate-x-full"
  x-transition:enter-end="translate-x-0"
  x-transition:leave="transition transform duration-300"
  x-transition:leave-start="translate-x-0"
  x-transition:leave-end="-translate-x-full"
  class="fixed left-0 w-[250px] min-h-screen bg-gradient-to-br from-blue-600 to-sky-500 text-white pt-[60px] shadow-lg z-[999] transition-transform duration-300 transform lg:translate-x-0"
  :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }"
>

    <h4 class="text-center mb-4 font-bold text-lg">SMK PESAT</h4>
    <div class="px-6 mb-4">
      <div class="flex items-center">
        <img src="https://ui-avatars.com/api/?name={{ substr(auth()->user()->name, 0, 1) }}&background=random" class="rounded-full mr-3 w-10 h-10" />
        <div>
          <small class="block">Welcome back,</small>
          <strong class="capitalize">{{ auth()->user()->name }}</strong>
        </div>
      </div>
    </div>
    <a href="{{ route('home') }}" class="block px-6 py-3 border-l-4 border-transparent hover:bg-white/10 hover:border-white transition-all duration-300 hover:translate-x-1 text-white/90">
      <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
    </a>

    @if(auth()->check() && auth()->user()->role === 'admin')
      <a href="{{ route('admin') }}" class="block px-6 py-3 border-l-4 border-transparent hover:bg-white/10 hover:border-white transition-all duration-300 hover:translate-x-1 text-white/90">
        <i class="fa-solid fa-user-gear mr-2"></i> Admin
      </a>

      @if(request()->routeIs('admin'))
        <!-- Sub navigation (only visible on lg and up) -->
        <div class="hidden lg:block ml-10 space-y-1 text-sm">
          <a href="#semesters" class="block px-4 py-2 text-white/70 hover:text-white hover:translate-x-1 transition-all duration-300">
            Semesters
          </a>
          <a href="#users" class="block px-4 py-2 text-white/70 hover:text-white hover:translate-x-1 transition-all duration-300">
            Users
          </a>
          <a href="#criterias" class="block px-4 py-2 text-white/70 hover:text-white hover:translate-x-1 transition-all duration-300">
            Criterias
          </a>
          <a href="#components" class="block px-4 py-2 text-white/70 hover:text-white hover:translate-x-1 transition-all duration-300">
            Components
          </a>
        </div>
      @endif
    @endif

    <a href="{{ route('teacher.index') }}" class="block px-6 py-3 border-l-4 border-transparent hover:bg-white/10 hover:border-white transition-all duration-300 hover:translate-x-1 text-white/90">
      <i class="fas fa-users mr-2"></i> Data Guru
    </a>

    <a href="{{ route('activity') }}" class="block px-6 py-3 border-l-4 border-transparent hover:bg-white/10 hover:border-white transition-all duration-300 hover:translate-x-1 text-white/90">
      <i class="fas fa-building mr-2"></i> Aktivitas
    </a>

    <form method="POST" action="{{ route('logout') }}">
    @csrf
    <a href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();" class="block px-6 py-3 border-l-4 border-transparent hover:bg-white/10 hover:border-white transition-all duration-300 hover:translate-x-1 text-white/90">
      <i class="fas fa-sign-out-alt mr-2"></i> Logout
    </a>
    </form>
  </div>

