<x-app-layout>
  <div class="mx-auto px-4 py-12 relative z-10">
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
    <div class="grid md:grid-cols-2 gap-8 mb-16">

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
            <p class="text-white/70 text-sm font-medium mb-2">Banyak Evaluasi</p>
            <h2 class="text-4xl font-bold text-white">{{ $evaluationCount }}</h2>
          </div>
          <div class="stat-icon">
            <i class="fas fa-chart-line text-white text-2xl"></i>
          </div>
        </div>
      </div>

    </div>

    <!-- Teachers Table -->
    <div class="table-container overflow-auto xl:overflow-hidden">
      <div class="p-8">
        <div class="flex justify-between items-center mb-6">
          <h2 class="section-title">
            <i class="fas fa-graduation-cap mr-3"></i>
            Daftar Guru SMK Informatika Pesat
          </h2>

          <!-- Academic Year Filter -->
          <div class="flex items-center space-x-4">
            <form method="GET" action="{{ route('home') }}" class="flex items-center space-x-2">
              <label for="tahun_ajaran" class="text-blue-300 text-sm font-semibold">Filter Tahun Ajaran:</label>
              <select name="tahun_ajaran" id="tahun_ajaran" onchange="this.form.submit()"
                      class="bg-blue-600/80 border-2 border-blue-400 rounded-lg px-4 py-2 text-white text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-300 focus:border-blue-300 hover:bg-blue-500/80 transition-colors duration-200">
                <option value="" class="bg-gray-800">Semua Tahun</option>
                @for ($year = 2024; $year <= 2030; $year++)
                  <option value="{{ $year }}-{{ $year+1 }}" {{ request('tahun_ajaran') === $year.'-'.($year+1) ? 'selected' : '' }} class="bg-gray-800">
                    {{ $year }} - {{ $year+1 }}
                  </option>
                @endfor
              </select>
            </form>
          </div>
        </div>

        <div class="overflow-x-auto xl:overflow-hidden">
          <table class="w-full">
            <thead class="table-header">
              <tr>
                <th class="p-6 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">
                  Profil Guru
                </th>
                <th class="p-6 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">
                  Kualifikasi
                </th>
                <th class="p-6 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">
                  Bidang Keahlian
                </th>
                <th class="p-6 text-left text-sm font-bold text-gray-700 uppercase tracking-wider">
                  Status
                </th>
                @if(auth()->check() && auth()->user()->role !== 'guru')
                @foreach($semesters->take(3) as $semester)
                <th class="p-6 text-center text-sm font-bold text-gray-700 uppercase tracking-wider">
                  {{ $semester->tahun_ajaran }}<br>
                  <small class="text-xs">{{ $semester->semester == 1 ? 'Ganjil' : 'Genap' }}</small>
                </th>
                @endforeach
                @else
                @foreach($semesters as $semester)
                <th class="p-6 text-center text-sm font-bold text-gray-700 uppercase tracking-wider">
                  {{ $semester->tahun_ajaran }}<br>
                  <small class="text-xs">{{ $semester->semester == 1 ? 'Ganjil' : 'Genap' }}</small>
                </th>
                @endforeach
                @endif
                <th class="p-6 text-center text-sm font-bold text-gray-700 uppercase tracking-wider">
                  Aksi
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($teachers as $data)
              <tr class="table-row">
                <td class="p-6">
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
                <td class="p-6">
                  <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-purple-100 text-purple-800">
                    <i class="fas fa-medal mr-1"></i>
                    {{ $data->degree }}
                  </span>
                </td>
                <td class="p-6">
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
                <td class="p-6">
                  <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-blue-600 rounded-lg flex items-center justify-center">
                      <i class="fas fa-laptop-code text-white text-sm"></i>
                    </div>
                    <div>
                      <div class="text-sm font-bold text-gray-900">{{ $data->status }}</div>
                    </div>
                  </div>
                </td>
                @if(auth()->check() && auth()->user()->role !== 'guru')
                @foreach($semesters->take(3) as $semester)
                <td class="p-6 text-center">
                  <div class="score-badge">
                    <i class="fas fa-star mr-1"></i>
                    <span class="evalScore">
                      {{ $scores[$data->id][$semester->id]['score'] ?? '0.00' }}
                    </span>
                  </div>
                </td>
                @endforeach
                @else
                @foreach($semesters as $semester)
                <td class="p-6 text-center">
                  <div class="score-badge">
                    <i class="fas fa-star mr-1"></i>
                    <span class="evalScore">
                      {{ $scores[$data->id][$semester->id]['score'] ?? '0.00' }}
                    </span>
                  </div>
                </td>
                @endforeach
                @endif
                <td class="p-6 text-center">
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
