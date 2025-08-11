<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
        <title>Dashboard Admin - SMK Pesat</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet" />
        <style>
            @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
            }
            .floating-icon {
            animation: float 3s ease-in-out infinite;
            }
        </style>
    </head>
    <body
    x-data="{
      sidebarOpen: window.innerWidth >= 1024,
      init() {
        const mediaQuery = window.matchMedia('(min-width: 1024px)');
        this.sidebarOpen = mediaQuery.matches;

        mediaQuery.addEventListener('change', (e) => {
          this.sidebarOpen = e.matches;
        });
      }
    }"
    class="font-sans antialiased relative"
    >
    <div class="min-h-screen bg-gray-100">
      <!-- Navbar -->
      <nav class="fixed top-0 left-0 right-0 bg-white/90 backdrop-blur border-b border-gray-200 z-[1000]">
        <div class="flex items-center justify-between px-6 py-4">
          <!-- Hamburger -->
          <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-gray-700 mr-2">
            <i class="fas fa-bars text-xl"></i>
          </button>

          <span class="font-bold text-lg text-gray-800">
            <i class="fas fa-chart-line text-blue-600 mr-2"></i>
            Dashboard Overview
          </span>

          <button class="btn bg-gray-100 rounded-full w-10 h-10 flex items-center justify-center">
            <i class="fas fa-bell"></i>
          </button>
        </div>
      </nav>

      <!-- Sidebar (you probably have this in a separate include) -->
      @include('layouts.navigation')

      <!-- Overlay (on top of content, below sidebar) -->
      <div
        x-show="sidebarOpen && window.innerWidth < 1024"
        x-transition.opacity
        class="fixed inset-0 bg-black bg-opacity-50 z-40"
        @click="sidebarOpen = false">
      </div>

      <!-- Page Content -->
      <main :class="{ 'lg:ml-[250px]': sidebarOpen }" class="transition-all duration-300 mt-[70px] relative min-h-screen z-30 gradient-bg md:px-8">
        <div class="floating-elements">
          <div class="floating-circle"></div>
          <div class="floating-circle"></div>
          <div class="floating-circle"></div>
          <div class="floating-circle"></div>
          <div class="floating-circle"></div>
          <div class="floating-circle"></div>
        </div>
        {{ $slot }}
      </main>
    </div>
   <script>
  document.addEventListener("DOMContentLoaded", () => {
    const circles = document.querySelectorAll('.floating-circle');
    const total = circles.length;

    circles.forEach((circle, index) => {
      // Even horizontal spacing across the screen
      const spacing = 100 / total;
      const baseLeft = spacing * index + spacing / 2; // center within zone
      const horizontalOffset = Math.random() * 10 - 5; // -5% to +5%
      const left = baseLeft + horizontalOffset;

      // Vertical range: 10% – 70%
      const top = Math.floor(Math.random() * 71) + 10;

      // Controlled random size: 40px–60px
      const size = Math.floor(Math.random() * 21) + 40;

      // Optional random delay: 0–3s
      const delay = (Math.random() * 3).toFixed(2);

      // Apply styles
      circle.style.position = 'absolute';
      circle.style.left = `${left}%`;
      circle.style.top = `${top}%`;
      circle.style.width = `${size}px`;
      circle.style.height = `${size}px`;
      circle.style.animationDelay = `${delay}s`;
    });
  });

  // Show success message function
function showSuccessMessage(message) {
  // Create success alert element
  const alert = document.createElement('div');
  alert.className = 'success-alert';
  alert.innerHTML = `
    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
      <i class="fas fa-check text-white text-sm"></i>
    </div>
    <div>
      <h4 class="font-bold text-green-800">Berhasil!</h4>
      <p class="text-green-700">${message}</p>
    </div>
  `;

  // Insert at the top of content
  const contentCard = document.querySelector('.content-card .text-gray-900');
  contentCard.insertBefore(alert, contentCard.firstChild);

  // Auto remove after 5 seconds
  setTimeout(() => {
    alert.style.transition = 'all 0.5s ease';
    alert.style.transform = 'translateX(-100%)';
    alert.style.opacity = '0';
    setTimeout(() => {
      alert.remove();
    }, 500);
  }, 5000);
}
</script>



  </body>

</html>
