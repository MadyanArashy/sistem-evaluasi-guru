<x-app-layout>
<style>
@keyframes gradientShift {
  0%, 100% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
}

.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 32px;
  padding-bottom: 20px;
  border-bottom: 2px solid rgba(99, 102, 241, 0.1);
  position: relative;
}

.section-header::after {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 120px;
  height: 2px;
  background: linear-gradient(135deg, #3b82f6, #1d4ed8);
  border-radius: 1px;
}

.add-btn {
  background: linear-gradient(135deg, #3b82f6, #1d4ed8);
  color: white;
  padding: 16px 32px;
  border-radius: 16px;
  font-weight: 600;
  font-size: 1rem;
  transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  border: none;
  cursor: pointer;
  position: relative;
  overflow: hidden;
  box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3);
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}

.table-container {
  border-radius: 24px;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
  background: rgba(255, 255, 255, 0.9);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(255, 255, 255, 0.3);
  margin-bottom: 40px;
}

.table-header {
  background: linear-gradient(135deg, #f8fafc, #e2e8f0);
  position: relative;
}

.table-header::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 3px;
 background: linear-gradient(135deg, #3b82f6, #1d4ed8);
}

.pedagogik { background: linear-gradient(135deg, #3b82f6, #1e40af); }
.kepribadian { background: linear-gradient(135deg, #10b981, #047857); }
.professional { background: linear-gradient(135deg, #f59e0b, #d97706); }
.sosial { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }

.weight-badge {
  background: linear-gradient(135deg, #3b82f6, #1d4ed8);
  color: white;
  padding: 8px 16px;
  border-radius: 20px;
  font-weight: 700;
  font-size: 0.875rem;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  box-shadow: 0 8px 16px rgba(99, 102, 241, 0.3);
  position: relative;
  overflow: hidden;
}

.weight-badge::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
  transition: left 0.5s ease;
}

.weight-badge:hover::before {
  left: 100%;
}

.action-btn {
  padding: 12px 20px;
  border-radius: 10px;
  font-weight: 600;
  font-size: 0.875rem;
  transition: all 0.3s ease;
  border: none;
  cursor: pointer;
  margin: 0 4px;
  position: relative;
  overflow: hidden;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}

.edit-btn {
  background: linear-gradient(135deg, #f59e0b, #d97706);
  color: white;
  box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
}

.edit-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(245, 158, 11, 0.4);
}

.delete-btn {
  background: linear-gradient(135deg, #ef4444, #dc2626);
  color: white;
  box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
}

.delete-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(239, 68, 68, 0.4);
}

.component-name {
  font-weight: 600;
  color: #1f2937;
  margin-bottom: 4px;
}

.component-description {
  font-size: 0.875rem;
  color: #6b7280;
}

.criteria-badge {
  background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));
  border: 1px solid rgba(99, 102, 241, 0.2);
  color: #4f46e5;
  padding: 6px 12px;
  border-radius: 12px;
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

@media (max-width: 768px) {
  .content-card {
    margin: 16px;
    padding: 24px;
    border-radius: 24px;
  }

  .section-title {
    font-size: 1.5rem;
  }

  .table-container {
    border-radius: 16px;
  }

  .section-header {
    flex-direction: column;
    gap: 16px;
    align-items: stretch;
  }

  .add-btn {
    justify-content: center;
  }
}
</style>
  <!-- Main Content -->
  <div class="mx-auto px-2 py-12 relative z-10">
    <div class="content-card">
      <div class="text-gray-900">
       <!-- Success Message -->
      @if(session('success'))
      <div
          x-data="{ success: true }"
          x-show="success"
          x-transition
          class="success-alert flex items-center gap-3 p-4 bg-green-100 border border-green-300 rounded-lg"
      >
          <!-- Icon -->
          <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
              <i class="fas fa-check text-white text-sm"></i>
          </div>

          <!-- Message -->
          <div class="flex-1">
              <h4 class="font-bold text-green-800">Berhasil!</h4>
              <p class="text-green-700">{{ session('success') }}</p>
          </div>

          <!-- Close Button -->
          <button
              @click="success = false"
              class="w-8 h-8 bg-gradient-to-br from-red-500 to-orange-600 rounded-lg flex items-center justify-center text-white font-bold text-sm hover:opacity-80"
          >
              <i class="fa-solid fa-x"></i>
          </button>
      </div>
      @endif

        <div class="relative">

          <!-- Users Table -->
          <div class="section-header">
            <h3 class="section-title">
              <i class="fas fa-users-cog text-blue-600"></i>
              Data Users
            </h3>
            <a href="#" class="add-btn">
              <i class="fas fa-plus"></i>
              Tambah User
            </a>
          </div>

          <div class="table-container overflow-auto lg:overflow-hidden">
            <table class="min-w-full">
              <thead class="table-header">
                <tr>
                  <th class="text-left">No</th>
                  <th class="text-left">Nama</th>
                  <th class="text-center">Role</th>
                  <th class="text-center">Pembuatan Akun</th>
                  <th class="text-center">Tindakan</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                <tr class="table-row">
                <td class="p-6">
                  <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                    1
                  </div>
                </td>
                <td class="flex items-center gap-2 p-6">
                <div class="w-12 h-12 p-3 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-xl flex items-center justify-center">
                  <i class="fas fa-user text-white"></i>
                </div>
                <div class="min-w-[150px]">
                  <div class="component-name font-semibold">{{ $user->name }}</div>
                  <div class="component-description text-gray-500">{{ $user->id }}</div>
                </div>
              </td>
              <td class="p-6 text-center w-32">
                <div class="weight-badge inline-flex items-center gap-1">
                  <i class="fas fa-user-tag"></i>
                  {{ $user->role }}
                </div>
              </td>
                <td class="p-6 text-center">
                  {{ $user->created_at->format('d M Y') }}
                </td>
                <td class="p-6 text-center">
                  <div class="flex justify-center space-x-2">
                    <a href="#" class="action-btn edit-btn">
                      <i class="fas fa-edit"></i>Edit
                    </a>
                    <button type="button" class="action-btn delete-btn">
                      <i class="fas fa-trash"></i>Hapus
                    </button>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- Kriteria Table -->
        <div class="section-header">
          <h3 class="section-title">
            <i class="fas fa-list-check text-blue-600"></i>
            Kriteria Evaluasi
          </h3>
          <a href="{{ route('criteria.create') }}" class="add-btn">
            <i class="fas fa-plus"></i>
            Tambah Kriteria
          </a>
        </div>

        <div class="table-container overflow-auto lg:overflow-hidden">
          <table class="min-w-full">
            <thead class="table-header">
              <tr>
                <th class="text-left">No</th>
                <th class="text-left">Nama Kriteria</th>
                <th class="text-center">Bobot</th>
                <th class="text-center">Tindakan</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1 ?>
              @foreach($criterias as $data)
              <tr class="table-row">
                <td class="p-6">
                  <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                    {{ $loop->iteration }}
                  </div>
                </td>
                <td class="flex items-center gap-4 p-6">
                  <div class="w-12 h-12 p-4 bg-gradient-to-br text-white rounded-xl flex items-center justify-center" style="background:{{ $data->style }}">
                    <i class="{{ $data->icon }}"></i>
                  </div>
                  <div class="min-w-60">
                    <div class="component-name">{{ $data->name }}</div>
                    <div class="component-description">{{ $data->description }}</div>
                  </div>
                </td>
                <td class="p-6 text-center">
                  <div class="weight-badge">
                    <i class="fas fa-percentage"></i>
                    {{ $data->weight }}%
                  </div>
                </td>
                <td class="p-6 text-center">
                  <div class="flex justify-center space-x-2">
                    <a href="#" class="action-btn edit-btn">
                      <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('criteria.destroy', $data->id) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this criteria?')">
                        <i class="fas fa-trash"></i> Hapus
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <!-- Komponen Table -->
        <div class="section-header">
          <h3 class="section-title">
            <i class="fas fa-puzzle-piece text-purple-600"></i>
            Komponen Evaluasi
          </h3>
          <a href="#" class="add-btn">
            <i class="fas fa-plus"></i>
            Tambah Komponen
          </a>
        </div>

        <div class="table-container overflow-auto lg:overflow-hidden">
          <table class="min-w-full">
            <thead class="table-header">
              <tr>
                <th class="text-left">No</th>
                <th class="text-left">Kriteria</th>
                <th class="text-left">Nama Komponen</th>
                <th class="text-center">Bobot</th>
                <th class="text-center">Tindakan</th>
              </tr>
            </thead>
            <tbody>
              <!-- Pedagogik Components -->
              <tr class="table-row">
                <td class="p-6">
                  <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                    1
                  </div>
                </td>
                <td class="p-6">
                  <div class="criteria-badge">Pedagogik</div>
                </td>
                <td class="p-6 min-w-60">
                  <div class="component-name">Bahan Ajar</div>
                  <div class="component-description">Kualitas dan kelengkapan bahan pembelajaran</div>
                </td>
                <td class="p-6 text-center">
                  <div class="weight-badge">
                    <i class="fas fa-percentage"></i>
                    30%
                  </div>
                </td>
                <td class="p-6 text-center">
                  <div class="flex justify-center space-x-2">
                    <a href="#" class="action-btn edit-btn">
                      <i class="fas fa-edit"></i>Edit
                    </a>
                    <button type="button" class="action-btn delete-btn" onclick="confirmDelete('Bahan Ajar')">
                      <i class="fas fa-trash"></i>Hapus
                    </button>
                  </div>
                </td>
              </tr>

              <tr class="table-row">
                <td class="p-6">
                  <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                    2
                  </div>
                </td>
                <td class="p-6">
                  <div class="criteria-badge">Pedagogik</div>
                </td>
                <td class="p-6 min-w-60">
                  <div class="component-name">Ketepatan Waktu</div>
                  <div class="component-description">Kehadiran dan ketepatan waktu dalam mengajar</div>
                </td>
                <td class="p-6 text-center">
                  <div class="weight-badge">
                    <i class="fas fa-percentage"></i>
                    30%
                  </div>
                </td>
                <td class="p-6 text-center">
                  <div class="flex justify-center space-x-2">
                    <a href="#" class="action-btn edit-btn">
                      <i class="fas fa-edit"></i>Edit
                    </a>
                    <button type="button" class="action-btn delete-btn" onclick="confirmDelete('Ketepatan Waktu')">
                      <i class="fas fa-trash"></i>Hapus
                    </button>
                  </div>
                </td>
              </tr>

              <!-- Kepribadian Components -->
              <tr class="table-row">
                <td class="p-6">
                  <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                    3
                  </div>
                </td>
                <td class="p-6">
                  <div class="criteria-badge" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(5, 150, 105, 0.1)); border-color: rgba(16, 185, 129, 0.2); color: #047857;">Kepribadian</div>
                </td>
                <td class="p-6 min-w-60">
                  <div class="component-name">Mengumpulkan Administrasi Guru</div>
                  <div class="component-description">Kelengkapan dan ketepatan administrasi pembelajaran</div>
                </td>
                <td class="p-6 text-center">
                  <div class="weight-badge">
                    <i class="fas fa-percentage"></i>
                    40%
                  </div>
                </td>
                <td class="p-6 text-center">
                  <div class="flex justify-center space-x-2">
                    <a href="#" class="action-btn edit-btn">
                      <i class="fas fa-edit"></i>Edit
                    </a>
                    <button type="button" class="action-btn delete-btn" onclick="confirmDelete('Administrasi Guru')">
                      <i class="fas fa-trash"></i>Hapus
                    </button>
                  </div>
                </td>
              </tr>

              <!-- Professional Components -->
              <tr class="table-row">
                <td class="p-6">
                  <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                    4
                  </div>
                </td>
                <td class="p-6">
                  <div class="criteria-badge" style="background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(217, 119, 6, 0.1)); border-color: rgba(245, 158, 11, 0.2); color: #d97706;">Profesional</div>
                </td>
                <td class="p-6 min-w-60">
                  <div class="component-name">Produktivitas dan Kreativitas</div>
                  <div class="component-description">Inovasi dalam metode pembelajaran dan hasil karya</div>
                </td>
                <td class="p-6 text-center">
                  <div class="weight-badge">
                    <i class="fas fa-percentage"></i>
                    35%
                  </div>
                </td>
                <td class="p-6 text-center">
                  <div class="flex justify-center space-x-2">
                    <a href="#" class="action-btn edit-btn">
                      <i class="fas fa-edit"></i>Edit
                    </a>
                    <button type="button" class="action-btn delete-btn" onclick="confirmDelete('Produktivitas dan Kreativitas')">
                      <i class="fas fa-trash"></i>Hapus
                    </button>
                  </div>
                </td>
              </tr>

              <tr class="table-row">
                <td class="p-6">
                  <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                    5
                  </div>
                </td>
                <td class="p-6">
                  <div class="criteria-badge" style="background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(217, 119, 6, 0.1)); border-color: rgba(245, 158, 11, 0.2); color: #d97706;">Profesional</div>
                </td>
                <td class="p-6 min-w-60">
                  <div class="component-name">Pengembangan Diri</div>
                  <div class="component-description">Partisipasi dalam pelatihan dan pengembangan profesional</div>
                </td>
                <td class="p-6 text-center">
                  <div class="weight-badge">
                    <i class="fas fa-percentage"></i>
                    25%
                  </div>
                </td>
                <td class="p-6 text-center">
                  <div class="flex justify-center space-x-2">
                    <a href="#" class="action-btn edit-btn">
                      <i class="fas fa-edit"></i>Edit
                    </a>
                    <button type="button" class="action-btn delete-btn" onclick="confirmDelete('Pengembangan Diri')">
                      <i class="fas fa-trash"></i>Hapus
                    </button>
                  </div>
                </td>
              </tr>

              <!-- Social Components -->
              <tr class="table-row">
                <td class="p-6">
                  <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                    6
                  </div>
                </td>
                <td class="p-6">
                  <div class="criteria-badge" style="background: linear-gradient(135deg, rgba(139, 92, 246, 0.1), rgba(124, 58, 237, 0.1)); border-color: rgba(139, 92, 246, 0.2); color: #7c3aed;">Sosial</div>
                </td>
                <td class="p-6 min-w-60">
                  <div class="component-name">Komunikasi dengan Siswa</div>
                  <div class="component-description">Kemampuan berkomunikasi efektif dengan peserta didik</div>
                </td>
                <td class="p-6 text-center">
                  <div class="weight-badge">
                    <i class="fas fa-percentage"></i>
                    50%
                  </div>
                </td>
                <td class="p-6 text-center">
                  <div class="flex justify-center space-x-2">
                    <a href="#" class="action-btn edit-btn">
                      <i class="fas fa-edit"></i>Edit
                    </a>
                    <button type="button" class="action-btn delete-btn" onclick="confirmDelete('Komunikasi dengan Siswa')">
                      <i class="fas fa-trash"></i>Hapus
                    </button>
                  </div>
                </td>
              </tr>

              <tr class="table-row">
                <td class="p-6">
                  <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                    7
                  </div>
                </td>
                <td class="p-6">
                  <div class="criteria-badge" style="background: linear-gradient(135deg, rgba(139, 92, 246, 0.1), rgba(124, 58, 237, 0.1)); border-color: rgba(139, 92, 246, 0.2); color: #7c3aed;">Sosial</div>
                </td>
                <td class="p-6 min-w-60">
                  <div class="component-name">Kerjasama Tim</div>
                  <div class="component-description">Kolaborasi dengan sesama guru dan staff sekolah</div>
                </td>
                <td class="p-6 text-center">
                  <div class="weight-badge">
                    <i class="fas fa-percentage"></i>
                    30%
                  </div>
                </td>
                <td class="p-6 text-center">
                  <div class="flex justify-center space-x-2">
                    <a href="#" class="action-btn edit-btn">
                      <i class="fas fa-edit"></i>Edit
                    </a>
                    <button type="button" class="action-btn delete-btn" onclick="confirmDelete('Kerjasama Tim')">
                      <i class="fas fa-trash"></i>Hapus
                    </button>
                  </div>
                </td>
              </tr>

              <tr class="table-row">
                <td class="p-6">
                  <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                    8
                  </div>
                </td>
                <td class="p-6">
                  <div class="criteria-badge">Pedagogik</div>
                </td>
                <td class="p-6 min-w-60">
                  <div class="component-name">Metode Pembelajaran</div>
                  <div class="component-description">Variasi dan efektivitas metode pembelajaran yang digunakan</div>
                </td>
                <td class="p-6 text-center">
                  <div class="weight-badge">
                    <i class="fas fa-percentage"></i>
                    40%
                  </div>
                </td>
                <td class="p-6 text-center">
                  <div class="flex justify-center space-x-2">
                    <a href="#" class="action-btn edit-btn">
                      <i class="fas fa-edit"></i>Edit
                    </a>
                    <button type="button" class="action-btn delete-btn" onclick="confirmDelete('Metode Pembelajaran')">
                      <i class="fas fa-trash"></i>Hapus
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Summary Cards -->
        <div class="grid md:grid-cols-2 gap-8 mt-12">
          <div class="p-8 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl border border-blue-200">
            <div class="flex items-center justify-between mb-6">
              <h4 class="text-xl font-bold text-gray-800">Total Kriteria</h4>
              <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                <i class="fas fa-list-check text-white text-lg"></i>
              </div>
            </div>
            <div class="text-3xl font-bold text-blue-600 mb-2">4</div>
            <p class="text-gray-600 text-sm">Kriteria evaluasi aktif</p>
            <div class="mt-4 text-xs text-gray-500">
              Total bobot: <span class="font-semibold text-blue-600" id="criteriaWeight"></span>
            </div>
          </div>

          <div class="p-8 bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl border border-purple-200">
            <div class="flex items-center justify-between mb-6">
              <h4 class="text-xl font-bold text-gray-800">Total Komponen</h4>
              <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center">
                <i class="fas fa-puzzle-piece text-white text-lg"></i>
              </div>
            </div>
            <div class="text-3xl font-bold text-purple-600 mb-2">8</div>
            <p class="text-gray-600 text-sm">Komponen evaluasi terdefinisi</p>
            <div class="mt-4 grid grid-cols-2 gap-2 text-xs">
              <div class="text-gray-500">Pedagogik: <span class="font-semibold text-blue-600">3 komponen</span></div>
              <div class="text-gray-500">Kepribadian: <span class="font-semibold text-green-600">1 komponen</span></div>
              <div class="text-gray-500">Profesional: <span class="font-semibold text-orange-600">2 komponen</span></div>
              <div class="text-gray-500">Sosial: <span class="font-semibold text-purple-600">2 komponen</span></div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

<!-- Enhanced JavaScript -->
<script>
// Add smooth scrolling between tables
function scrollToTable(tableId) {
  document.getElementById(tableId).scrollIntoView({
    behavior: 'smooth',
    block: 'start'
  });
}

// Auto-calculate total percentages (you can extend this)
function calculateTotalPercentage() {
  const criteriaWeights = @json($criterias->pluck('weight'));
  const totalCriteria = criteriaWeights.reduce((a, b) => a + b, 0);

  // Update the span text
  document.getElementById('criteriaWeight').textContent = `${totalCriteria}%`;

  // Log in console
  console.log(`Total criteria weight = ${totalCriteria}%`);

  // Validation warning
  if (totalCriteria !== 100) {
    console.warn('Warning: Total criteria weight does not equal 100%');
  }
}

// Initialize calculations
calculateTotalPercentage();
</script>
</x-app-layout>
