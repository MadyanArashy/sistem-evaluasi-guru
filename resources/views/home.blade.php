<x-app-layout>

  <!-- Content -->
  <div class="ml-[250px] mt-[80px] p-8">
    <div class="grid md:grid-cols-3 gap-6 mb-8">
      <div class="animate__animated animate__fadeInUp">
        <div class="relative rounded-xl shadow-lg transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl p-6 text-white" style="background: linear-gradient(45deg, #4e54c8, #8f94fb);">
          <div class="flex justify-between items-center relative z-10">
            <div>
              <p class="text-sm opacity-90">Total Guru</p>
              <h2 class="text-4xl font-semibold">35</h2>
            </div>
            <div class="floating-icon">
              <i class="fas fa-user-tie text-4xl opacity-90"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="animate__animated animate__fadeInUp animate__delay-1s">
        <div class="relative rounded-xl shadow-lg transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl p-6 text-white" style="background: linear-gradient(45deg, #11998e, #38ef7d);">
          <div class="flex justify-between items-center relative z-10">
            <div>
              <p class="text-sm opacity-90">Data Nilai</p>
              <h2 class="text-4xl font-semibold">128</h2>
            </div>
            <div class="floating-icon">
              <i class="fas fa-file-alt text-4xl opacity-90"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="animate__animated animate__fadeInUp animate__delay-2s">
        <div class="relative rounded-xl shadow-lg transition-transform duration-300 hover:-translate-y-1 hover:shadow-2xl p-6 text-white" style="background: linear-gradient(45deg, #FF8008, #FFC837);">
          <div class="flex justify-between items-center relative z-10">
            <div>
              <p class="text-sm opacity-90">Laporan Bulanan</p>
              <h2 class="text-4xl font-semibold">12</h2>
            </div>
            <div class="floating-icon">
              <i class="fas fa-chart-bar text-4xl opacity-90"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Recent Activity -->
    <div class="animate__animated animate__fadeInUp animate__delay-3s">
      <div class="bg-white rounded-xl shadow-lg p-6">
        <h5 class="text-lg font-semibold mb-4 text-gray-700">
          <i class="fas fa-clock mr-2 text-blue-600"></i>
          Aktivitas Terkini
        </h5>
        <div class="divide-y divide-gray-100">
          <div class="flex items-center py-4">
            <div class="bg-blue-100 p-3 rounded-full mr-4">
              <i class="fas fa-user-plus text-blue-600"></i>
            </div>
            <div>
              <h6 class="font-medium">Guru Baru Ditambahkan</h6>
              <small class="text-gray-500">2 menit yang lalu</small>
            </div>
          </div>
          <div class="flex items-center py-4">
            <div class="bg-green-100 p-3 rounded-full mr-4">
              <i class="fas fa-file-upload text-green-600"></i>
            </div>
            <div>
              <h6 class="font-medium">Nilai Siswa Diperbarui</h6>
              <small class="text-gray-500">1 jam yang lalu</small>
            </div>
          </div>
        </div>
      </div>
    </div>

    <hr class="my-8 border-gray-200">
    <p class="text-center text-sm text-gray-500">© 2025 SMK Pesat - All rights reserved</p>
  </div>

</x-app-layout>
