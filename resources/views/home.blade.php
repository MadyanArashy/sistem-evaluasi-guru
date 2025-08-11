<x-app-layout>
  <div class="container mx-auto px-2 py-12 relative z-10">
    <!-- Hero Section -->
    <div class="text-center mb-16">
      <h1 class="text-5xl font-bold text-white mb-4">
        Dashboard <span class="bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">SMK Pesat</span>
      </h1>
      <p class="text-xl text-white/80 max-w-2xl mx-auto">
        Sistem Manajemen <b>Evaluasi Guru</b> Terdepan untuk Pendidikan Berkualitas Tinggi
      </p>
    </div>

    <!-- Stats Cards -->
    <div class="grid md:grid-cols-3 gap-8 mb-16">
      <div class="stat-card p-8">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-white/70 text-sm font-medium mb-2">Total Guru</p>
            <h2 class="text-4xl font-bold text-white">{{ $teachers->count() }}</h2>
          </div>
          <div class="stat-icon">
            <i class="fas fa-user-tie text-white text-2xl"></i>
          </div>
        </div>
      </div>

      <div class="stat-card p-8">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-white/70 text-sm font-medium mb-2">Data Nilai</p>
            <h2 class="text-4xl font-bold text-white">128</h2>
          </div>
          <div class="stat-icon">
            <i class="fas fa-chart-line text-white text-2xl"></i>
          </div>
        </div>
      </div>

      <div class="stat-card p-8">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-white/70 text-sm font-medium mb-2">Laporan Bulanan</p>
            <h2 class="text-4xl font-bold text-white">12</h2>
            <p class="text-white/60 text-xs mt-1">✓ Target tercapai</p>
          </div>
          <div class="stat-icon">
            <i class="fas fa-file-chart-column text-white text-2xl"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Teachers Table -->
    <div class="table-container overflow-auto lg:overflow-hidden">
      <div class="p-8">
        <h2 class="section-title">
          <i class="fas fa-graduation-cap mr-3"></i>
          Daftar Guru SMK Informatika Pesat
        </h2>

        <div class="overflow-x-auto">
          <table class="w-full">
            <thead class="table-header">
              <tr>
                <th class="px-6 py-6 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">
                  Profil Guru
                </th>
                <th class="px-6 py-6 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">
                  Kualifikasi
                </th>
                <th class="px-6 py-6 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">
                  Bidang Keahlian
                </th>
                <th class="px-6 py-6 text-center text-sm font-bold text-gray-700 uppercase tracking-wider">
                  Performa
                </th>
                <th class="px-6 py-6 text-center text-sm font-bold text-gray-700 uppercase tracking-wider">
                  Aksi
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($teachers as $data)
              <tr class="table-row">
                <td class="px-6 py-6">
                  <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 p-4 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                      {{ substr($data->name, 0, 1) }}
                    </div>
                    <div>
                      <p class="text-lg font-bold text-gray-900 block">{{ $data->name }}</p>
                      <div class="text-sm text-gray-500">Guru Profesional</div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-6">
                  <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-purple-100 text-purple-800">
                    <i class="fas fa-medal mr-1"></i>
                    {{ $data->degree }}
                  </span>
                </td>
                <td class="px-6 py-6">
                  <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-blue-600 rounded-lg flex items-center justify-center">
                      <i class="fas fa-laptop-code text-white text-sm"></i>
                    </div>
                    <div>
                      <div class="text-sm font-bold text-gray-900">{{ $data->subject }}</div>
                      <div class="text-xs text-gray-500">Mata Pelajaran</div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-6 text-center">
                  <div class="score-badge">
                    <i class="fas fa-star mr-1"></i>
                    4.5/5.0
                  </div>
                </td>
                <td class="px-6 py-6 text-center">
                  <a href="{{ route('teacher.show', ['id' => $data->id]) }}" class="detail-btn w-40">
                    <i class="fas fa-eye mr-2"></i>
                    Lihat Detail
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

          <div class="p-6 border-t border-gray-100">
            <a href="{{ route('teacher.index') }}" class="more-btn">
              <i class="fas fa-arrow-right mr-2"></i>
              Lihat Semua Guru
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Recent Activity -->
    <div class="activity-card">
      <h2 class="section-title">
        <i class="fas fa-clock mr-3"></i>
        Aktivitas Terkini
      </h2>

      <div class="space-y-4">
        <div class="activity-item flex items-center space-x-4">
          <div class="activity-icon bg-gradient-to-br from-blue-500 to-cyan-600">
            <i class="fas fa-user-plus text-white text-lg"></i>
          </div>
          <div class="flex-1">
            <h6 class="font-bold text-gray-900">Guru Baru Bergabung</h6>
            <p class="text-sm text-gray-600">Dr. Ahmad Wijaya telah bergabung sebagai guru Matematika</p>
            <small class="text-xs text-gray-400">2 menit yang lalu</small>
          </div>
          <div class="text-green-500">
            <i class="fas fa-check-circle text-xl"></i>
          </div>
        </div>

        <div class="activity-item flex items-center space-x-4">
          <div class="activity-icon bg-gradient-to-br from-green-500 to-emerald-600">
            <i class="fas fa-file-upload text-white text-lg"></i>
          </div>
          <div class="flex-1">
            <h6 class="font-bold text-gray-900">Nilai Siswa Diperbarui</h6>
            <p class="text-sm text-gray-600">128 data nilai berhasil diperbarui untuk semester ini</p>
            <small class="text-xs text-gray-400">1 jam yang lalu</small>
          </div>
          <div class="text-blue-500">
            <i class="fas fa-info-circle text-xl"></i>
          </div>
        </div>

        <div class="activity-item flex items-center space-x-4">
          <div class="activity-icon bg-gradient-to-br from-purple-500 to-pink-600">
            <i class="fas fa-chart-bar text-white text-lg"></i>
          </div>
          <div class="flex-1">
            <h6 class="font-bold text-gray-900">Laporan Bulanan Siap</h6>
            <p class="text-sm text-gray-600">Laporan evaluasi bulan ini telah selesai dibuat</p>
            <small class="text-xs text-gray-400">3 jam yang lalu</small>
          </div>
          <div class="text-purple-500">
            <i class="fas fa-download text-xl"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <div class="footer-section">
      <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-center space-x-4 mb-6">
          <div class="w-16 h-16 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-full flex items-center justify-center">
            <i class="fas fa-graduation-cap text-white text-2xl"></i>
          </div>
          <div>
            <h3 class="text-2xl font-bold text-white">SMK Informatika Pesat</h3>
            <p class="text-white/70">Membangun Generasi Digital Masa Depan</p>
          </div>
        </div>
        <p class="text-white/60 text-sm">
          © 2025 SMK Pesat - Hak Cipta Dilindungi. Dibuat dengan ❤️ untuk pendidikan berkualitas.
        </p>
      </div>
    </div>
  </div>
</x-app-layout>
