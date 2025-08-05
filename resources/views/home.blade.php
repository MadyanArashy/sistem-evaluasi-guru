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

    <!-- Data Tabel Penilaian Guru -->
    <div class="animate__animated animate__fadeInUp animate__delay-3s">
      <div class="bg-white rounded-xl shadow-lg p-6">
        <h5 class="text-lg font-semibold mb-4 text-gray-700">
          <i class="fas fa-table mr-2 text-purple-600"></i>
          Data Penilaian Guru Bulanan
        </h5>
        
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Nama Guru
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Gelar
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Mata Pelajaran
                </th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Skor Evaluasi
                </th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Aksi
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-8 w-8">
                      <i class="fas fa-user-tie text-blue-500 text-lg"></i>
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-blue-600 font-semibold">Siti Rahayu</div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">Dr., M.Pd</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-8 w-8">
                      <i class="fas fa-book text-blue-500 text-lg"></i>
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">Matematika</div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                  <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                    4.5
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                  <div class="flex gap-2 justify-center">
                    <button class="text-blue-600 hover:text-blue-900 font-medium text-sm bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-md transition-colors">
                      <i class="fas fa-eye mr-1"></i>
                      Detail
                    </button>
                    <button class="text-yellow-600 hover:text-yellow-900 font-medium text-sm bg-yellow-50 hover:bg-yellow-100 px-3 py-1 rounded-md transition-colors">
                      <i class="fas fa-star mr-1"></i>
                      Evaluasi
                    </button>
                  </div>
                </td>
              </tr>
              
              <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-8 w-8">
                      <i class="fas fa-user-tie text-green-500 text-lg"></i>
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">Budi Santoso</div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">S.Pd</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-8 w-8">
                      <i class="fas fa-flask text-green-500 text-lg"></i>
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">IPA (Fisika)</div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                  <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                    3.8
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                  <div class="flex gap-2 justify-center">
                    <button class="text-blue-600 hover:text-blue-900 font-medium text-sm bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-md transition-colors">
                      <i class="fas fa-eye mr-1"></i>
                      Detail
                    </button>
                    <button class="text-yellow-600 hover:text-yellow-900 font-medium text-sm bg-yellow-50 hover:bg-yellow-100 px-3 py-1 rounded-md transition-colors">
                      <i class="fas fa-star mr-1"></i>
                      Evaluasi
                    </button>
                  </div>
                </td>
              </tr>
              
              <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-8 w-8">
                      <i class="fas fa-user-tie text-purple-500 text-lg"></i>
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">Ani Wijaya</div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">M.Hum</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-8 w-8">
                      <i class="fas fa-globe text-purple-500 text-lg"></i>
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">Bahasa Indonesia</div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                  <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                    4.2
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                  <div class="flex gap-2 justify-center">
                    <button class="text-blue-600 hover:text-blue-900 font-medium text-sm bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-md transition-colors">
                      <i class="fas fa-eye mr-1"></i>
                      Detail
                    </button>
                    <button class="text-yellow-600 hover:text-yellow-900 font-medium text-sm bg-yellow-50 hover:bg-yellow-100 px-3 py-1 rounded-md transition-colors">
                      <i class="fas fa-star mr-1"></i>
                      Evaluasi
                    </button>
                  </div>
                </td>
              </tr>
              
              <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-8 w-8">
                      <i class="fas fa-user-tie text-red-500 text-lg"></i>
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">Dewi Lestari</div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">S.Sn</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-8 w-8">
                      <i class="fas fa-palette text-red-500 text-lg"></i>
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">Seni Budaya</div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                  <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                    3.5
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                  <div class="flex gap-2 justify-center">
                    <button class="text-blue-600 hover:text-blue-900 font-medium text-sm bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-md transition-colors">
                      <i class="fas fa-eye mr-1"></i>
                      Detail
                    </button>
                    <button class="text-yellow-600 hover:text-yellow-900 font-medium text-sm bg-yellow-50 hover:bg-yellow-100 px-3 py-1 rounded-md transition-colors">
                      <i class="fas fa-star mr-1"></i>
                      Evaluasi
                    </button>
                  </div>
                </td>
              </tr>
              
              <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-8 w-8">
                      <i class="fas fa-user-tie text-orange-500 text-lg"></i>
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">Ahmad Fauzi</div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">S.Pd</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-8 w-8">
                      <i class="fas fa-dumbbell text-orange-500 text-lg"></i>
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">Pendidikan Jasmani</div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                  <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                    4.0
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                  <div class="flex gap-2 justify-center">
                    <button class="text-blue-600 hover:text-blue-900 font-medium text-sm bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-md transition-colors">
                      <i class="fas fa-eye mr-1"></i>
                      Detail
                    </button>
                    <button class="text-yellow-600 hover:text-yellow-900 font-medium text-sm bg-yellow-50 hover:bg-yellow-100 px-3 py-1 rounded-md transition-colors">
                      <i class="fas fa-star mr-1"></i>
                      Evaluasi
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Recent Activity -->
    <div class="animate__animated animate__fadeInUp animate__delay-4s mt-[40px]">
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
