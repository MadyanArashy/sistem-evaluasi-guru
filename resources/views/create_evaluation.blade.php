<x-app-layout>
  <style>
    .gradient-text {
      background: linear-gradient(135deg, #2563eb, #0ea5e9);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }
    .gradient-element {
      background: linear-gradient(135deg, #2563eb, #0ea5e9);
    }

    .pedagogik { background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: white; }
    .profesional { background: linear-gradient(135deg, #10b981, #059669); color: white; }
    .kepribadian { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; }
    .sosial { background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: white; }

    .score-display {
      background: linear-gradient(135deg, #f8fafc, #e2e8f0);
      padding: 12px 20px;
      border-radius: 16px;
      font-weight: 700;
      font-size: 1.1rem;
      color: #1f2937;
      border: 2px solid transparent;
      background-clip: padding-box;
      position: relative;
    }

    .score-excellent { border-color: #10b981; color: #065f46; background: linear-gradient(135deg, #d1fae5, #a7f3d0); }
    .score-good { border-color: #3b82f6; color: #1e40af; background: linear-gradient(135deg, #dbeafe, #93c5fd); }
    .score-fair { border-color: #f59e0b; color: #92400e; background: linear-gradient(135deg, #fef3c7, #fcd34d); }
    .score-poor { border-color: #ef4444; color: #991b1b; background: linear-gradient(135deg, #fee2e2, #fca5a5); }

    .category-display {
      background: linear-gradient(135deg, #6366f1, #4f46e5);
      color: white;
      padding: 8px 16px;
      border-radius: 12px;
      font-weight: 600;
      font-size: 0.9rem;
      text-align: center;
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .all-score {
      background: linear-gradient(135deg, #2563eb, #0ea5e9);
      color: white;
      padding: 12px 20px;
      border-radius: 16px;
      font-weight: 700;
      font-size: 1.2rem;
      text-align: center;
      box-shadow: 0 8px 24px rgba(37, 99, 235, 0.3);
      position: relative;
      overflow: hidden;
    }

    .all-score::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
      transition: left 0.5s ease;
    }

    .all-score:hover::before {
      left: 100%;
    }
  </style>

  <div class="mx-auto px-2 py-12 relative z-10">
    <div class="content-card">
      <!-- Teacher Header -->
      <div class="flex flex-row items-center mb-8 space-x-8">
        <div class="w-24 h-24 rounded-full gradient-element flex items-center justify-center shadow-lg border-4 border-yellow-300">
          <i class="fa-solid fa-user text-gray-50 text-5xl"></i>
        </div>
        <div>
          <h3 class="text-4xl font-bold gradient-text">
            {{ $teacher->name }} {{ $teacher->degree }}
          </h3>
          <p class="text-xl">
            {{ $teacher->subject }}
          </p>
        </div>
      </div>

      <!-- Success Message -->
      @if(session('success'))
        @include('partials.success')
      @endif

      <!-- Evaluation Summary Cards -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="stat-card p-6">
          <div class="flex items-center space-x-4">
            <div class="stat-icon pedagogik">
              <i class="fa-solid fa-chalkboard-teacher text-white text-xl"></i>
            </div>
            <div>
              <p class="text-sm text-gray-600 font-medium">Pedagogik</p>
              <p class="text-2xl font-bold text-gray-800">4.2</p>
            </div>
          </div>
        </div>

        <div class="stat-card p-6">
          <div class="flex items-center space-x-4">
            <div class="stat-icon profesional">
              <i class="fa-solid fa-graduation-cap text-white text-xl"></i>
            </div>
            <div>
              <p class="text-sm text-gray-600 font-medium">Profesional</p>
              <p class="text-2xl font-bold text-gray-800">4.5</p>
            </div>
          </div>
        </div>

        <div class="stat-card p-6">
          <div class="flex items-center space-x-4">
            <div class="stat-icon kepribadian">
              <i class="fa-solid fa-user-check text-white text-xl"></i>
            </div>
            <div>
              <p class="text-sm text-gray-600 font-medium">Kepribadian</p>
              <p class="text-2xl font-bold text-gray-800">4.8</p>
            </div>
          </div>
        </div>

        <div class="stat-card p-6">
          <div class="flex items-center space-x-4">
            <div class="stat-icon sosial">
              <i class="fa-solid fa-users text-white text-xl"></i>
            </div>
            <div>
              <p class="text-sm text-gray-600 font-medium">Sosial</p>
              <p class="text-2xl font-bold text-gray-800">4.3</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Evaluation Components Table -->
      <div class="table-container overflow-auto xl:overflow-hidden">
        <table class="min-w-full" id="guruTable">
          <thead class="table-header">
            <tr>
              <th class="text-left">No</th>
              <th class="text-left">Komponen</th>
              <th class="text-center">Nilai</th>
              <th class="text-center">Kategori</th>
              <th class="text-center">All</th>
            </tr>
          </thead>
          <tbody>
            <!-- Pedagogik Section -->
            <?php $no = 1 ?>
            <tr class="table-row">
              <td class="p-6">
                <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                  {{ $no++ }}
                </div>
              </td>
              <td class="p-6">
                <div class="space-y-2">
                  <div class="flex items-center space-x-3">
                    <h4 class="font-semibold text-gray-800">Hasil Supervisi Pra Mengajar</h4>
                  </div>
                  <p class="text-sm text-gray-600">Kelengkapan modul ajar, bahan ajar, instrumen penilaian</p>
                </div>
              </td>
              <td class="p-6 text-center">
                <div class="score-display score-good inline-block">4.2</div>
              </td>
              <td class="p-6 text-center">
                <div class="category-display inline-block">60</div>
              </td>
              <td class="p-6 text-center">
                <div class="all-score inline-block">25</div>
              </td>
            </tr>

            <tr class="table-row">
              <td class="p-6">
                <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                  {{ $no++ }}
                </div>
              </td>
              <td class="p-6">
                <div class="space-y-2">
                  <div class="flex items-center space-x-3">
                    <h4 class="font-semibold text-gray-800">Ketepatan Waktu</h4>
                  </div>
                  <p class="text-sm text-gray-600">Ketepatan waktu mengumpulkan administrasi guru</p>
                </div>
              </td>
              <td class="p-6 text-center">
                <div class="score-display score-excellent inline-block">4.8</div>
              </td>
              <td class="p-6 text-center">
                <div class="category-display inline-block">40</div>
              </td>
              <td class="p-6 text-center">
                <div class="all-score inline-block">25</div>
              </td>
            </tr>

            <!-- Profesional Section -->
            <tr class="table-row">
              <td class="p-6">
                <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                  {{ $no++ }}
                </div>
              </td>
              <td class="p-6">
                <div class="space-y-2">
                  <div class="flex items-center space-x-3">
                    <h4 class="font-semibold text-gray-800">Internalisasi dan Pemahaman</h4>
                  </div>
                  <p class="text-sm text-gray-600">Visi, Value, Motto, Identitas dan School Branding. Dinilai dari wawancara dan pengamatan harian.</p>
                </div>
              </td>
              <td class="p-6 text-center">
                <div class="score-display score-excellent inline-block">4.5</div>
              </td>
              <td class="p-6 text-center">
                <div class="category-display inline-block">100</div>
              </td>
              <td class="p-6 text-center">
                <div class="all-score inline-block">25</div>
              </td>
            </tr>

            <!-- Kepribadian Section -->
            <tr class="table-row">
              <td class="p-6">
                <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                  {{ $no++ }}
                </div>
              </td>
              <td class="p-6">
                <div class="space-y-2">
                  <div class="flex items-center space-x-3">
                    <h4 class="font-semibold text-gray-800">Tingkat Kehadiran</h4>
                  </div>
                  <p class="text-sm text-gray-600">Kehadiran guru dan hari masuk</p>
                </div>
              </td>
              <td class="p-6 text-center">
                <div class="score-display score-excellent inline-block">4.9</div>
              </td>
              <td class="p-6 text-center">
                <div class="category-display inline-block">60</div>
              </td>
              <td class="p-6 text-center">
                <div class="all-score inline-block">25</div>
              </td>
            </tr>

            <tr class="table-row">
              <td class="p-6">
                <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                  {{ $no++ }}
                </div>
              </td>
              <td class="p-6">
                <div class="space-y-2">
                  <div class="flex items-center space-x-3">
                    <h4 class="font-semibold text-gray-800">Tingkat Keterlambatan</h4>
                  </div>
                  <p class="text-sm text-gray-600">Ketepatan waktu saat datang ke sekolah</p>
                </div>
              </td>
              <td class="p-6 text-center">
                <div class="score-display score-good inline-block">4.7</div>
              </td>
              <td class="p-6 text-center">
                <div class="category-display inline-block">40</div>
              </td>
              <td class="p-6 text-center">
                <div class="all-score inline-block">25</div>
              </td>
            </tr>

            <!-- Sosial Section -->
            <tr class="table-row">
              <td class="p-6">
                <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                  {{ $no++ }}
                </div>
              </td>
              <td class="p-6">
                <div class="space-y-2">
                  <div class="flex items-center space-x-3">
                    <h4 class="font-semibold text-gray-800">Hubungan Sosial</h4>
                  </div>
                  <p class="text-sm text-gray-600">Hubungan antara guru dan komunitas sekolah</p>
                </div>
              </td>
              <td class="p-6 text-center">
                <div class="score-display score-good inline-block">4.3</div>
              </td>
              <td class="p-6 text-center">
                <div class="category-display inline-block">100</div>
              </td>
              <td class="p-6 text-center">
                <div class="all-score inline-block">25</div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Overall Score Section -->
      <div class="mt-8 p-8 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl border-2 border-blue-200">
        <div class="text-center">
          <h3 class="text-2xl font-bold gradient-text mb-4">Skor Evaluasi Keseluruhan</h3>
          <div class="flex justify-center items-center space-x-8">
            <div class="text-center">
              <p class="text-sm text-gray-600 mb-2">Total Skor</p>
              <div class="text-4xl font-bold text-blue-600">4.5</div>
            </div>
            <div class="text-center">
              <p class="text-sm text-gray-600 mb-2">Kategori</p>
              <div class="px-6 py-3 bg-green-500 text-white rounded-full font-bold text-lg">Sangat Baik</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="flex justify-center space-x-4 mt-8">
        <button class="add-btn action-btn">
          <i class="fa-solid fa-edit mr-2"></i>
          Edit Evaluasi
        </button>
        <button class="more-btn action-btn">
          <i class="fa-solid fa-print mr-2"></i>
          Cetak Laporan
        </button>
      </div>
    </div>
  </div>
</x-app-layout>
