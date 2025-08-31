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
        @if(session('success'))
          @include('partials.success')
        @endif
        <div class="relative">

        <!-- Users Table -->
        <div class="section-header">
          <h3 class="section-title">
            <i class="fas fa-users-cog text-blue-600"></i>
            Data Users
          </h3>
          <a href="{{ route('user.create') }}" class="add-btn">
            <i class="fas fa-plus"></i>
            Tambah User
          </a>
        </div>

        <div class="table-container overflow-auto xl:overflow-hidden">
          <table class="min-w-full" id="users">
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
              @foreach ($users as $data)
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
                <div class="component-name font-semibold">{{ $data->name }}</div>
                <div class="component-description text-gray-500">{{ $data->id }}</div>
              </div>
            </td>
            <td class="p-6 text-center w-32">
              <div class="weight-badge inline-flex items-center gap-1">
                <i class="fas fa-user-tag"></i>
                {{ $data->role }}
              </div>
            </td>
              <td class="p-6 text-center">
                {{ $data->created_at->format('d M Y') }}
              </td>
              <td class="p-6 text-center">
                <div class="flex justify-center space-x-2">
                  <a href="#" class="action-btn edit-btn">
                    <i class="fas fa-edit"></i>Edit
                  </a>
                  <form action="{{ route('user.destroy', $data->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="action-btn delete-btn"
                      onclick="return confirm('Are you sure you want to delete this user?')">
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

        <div class="table-container overflow-auto xl:overflow-hidden">
          <table class="min-w-full" id="criterias">
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
                    <a href="{{ route('criteria.edit', ['id' => $data->id]) }}" class="action-btn edit-btn">
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
          <a href="{{ route('component.create') }}" class="add-btn">
            <i class="fas fa-plus"></i>
            Tambah Komponen
          </a>
        </div>

        <div class="table-container overflow-auto xl:overflow-hidden">
          <table class="min-w-full" id="components">
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
              @php
                // Group by criteria_id
                $groupedComponents = $evalcomponents
                // Sort all components by criteria_id first
                ->sortBy('criteria_id')

                // Group them by criteria_id
                ->groupBy('criteria_id')

                // Sort the groups by the criteria_id key
                ->sortKeys()

                // Sort inside each group too
                ->map(function ($group) {
                    return $group->sortBy('criteria_id');
                });


              $no = 1;
              @endphp

              @foreach($groupedComponents as $criteriaId => $evalcomponentsGroup)
                @php
                  $criteria = $evalcomponentsGroup->first()->criteria;

                  // Extract colors from style
                  preg_match_all('/#([0-9a-fA-F]{6})/', $criteria->style, $matches);
                  $primaryColor = $matches[0][0] ?? '#000000';
                  $secondaryColor = $matches[0][1] ?? '#000000';

                  // Background RGBA with 0.1 opacity
                  list($r, $g, $b) = sscanf($primaryColor, "#%02x%02x%02x");
                  $bgColor = "rgba($r, $g, $b, 0.1)";
                @endphp

                  @foreach($evalcomponentsGroup as $data)
                    <tr class="table-row">
                      <td class="p-6">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center text-white font-bold text-sm"
                          style="background: {{ $primaryColor }};">
                          {{ $no++ }}
                        </div>
                      </td>
                      <td class="p-6">
                        <div class="criteria-badge px-3 py-1 rounded-lg font-semibold text-xs"
                          style="color: {{ $secondaryColor }}; background-color: {{ $bgColor }};">
                          {{ strtoupper($criteria->name) }}
                        </div>
                      </td>
                      <td class="p-6 min-w-60">
                        <div class="component-name font-semibold">{{ $data->name }}</div>
                        <div class="component-description text-sm text-gray-500">{{ $data->description }}</div>
                      </td>
                      <td class="p-6 text-center">
                        <div class="weight-badge px-3 py-1 rounded-lg font-semibold text-white"
                          style="background: {{ $criteria->style }};">
                          <i class="fas fa-percentage"></i>
                          {{ $data->weight }}%
                        </div>
                      </td>
                      <td class="p-6 text-center">
                        <div class="flex justify-center space-x-2">
                          <a href="{{ route('component.edit', ["id" => $data->id]) }}" class="action-btn edit-btn">
                            <i class="fas fa-edit"></i> Edit
                          </a>
                          <form action="{{ route('component.destroy', $data->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn delete-btn"
                              onclick="return confirm('Are you sure you want to delete this component?')">
                              <i class="fas fa-trash"></i> Hapus
                            </button>
                          </form>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                @endforeach
            </tbody>
          </table>
        </div>

        <!-- Summary Cards -->
        <div class="grid md:grid-cols-2 gap-8 mt-12" id="summary">
          <div class="p-8 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl border border-blue-200">
            <div class="flex items-center justify-between mb-6">
              <h4 class="text-xl font-bold text-gray-800">Total Kriteria</h4>
              <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                <i class="fas fa-list-check text-white text-lg"></i>
              </div>
            </div>
            <div class="text-3xl font-bold text-blue-600 mb-2">{{ $criterias->count() }}</div>
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
            <div class="text-3xl font-bold text-purple-600 mb-2">{{ $evalcomponents->count() }}</div>
            <p class="text-gray-600 text-sm">Komponen evaluasi terdefinisi</p>
            <div class="mt-4 grid grid-cols-2 gap-2 text-xs">
              @foreach($criterias as $criteria)
              @php
                preg_match_all('/#([0-9a-fA-F]{6})/', $criteria->style, $matches);
                $secondaryColor = $matches[0][1] ?? '#000000';
              @endphp
                <div>
                  {{ $criteria->name }}:
                  <span id="criteria-count-{{ $criteria->id }}"
                        class="font-semibold"
                        style="color: {{ $secondaryColor }}">
                    0 komponen
                  </span>
                </div>
              @endforeach
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

<!-- Enhanced JavaScript -->
<script>
function scrollToTable(tableId) {
  document.getElementById(tableId).scrollIntoView({
    behavior: 'smooth',
    block: 'start'
  });
}

function calculateTotalPercentage() {
  const criteriaWeights = @json($criterias->pluck('weight'));
  const totalCriteria = criteriaWeights.reduce((a, b) => a + b, 0);

  document.getElementById('criteriaWeight').textContent = `${totalCriteria}%`;

  if (totalCriteria !== 100) {
    console.warn('Warning: Total criteria weight does not equal 100%');
  }
}

// === Hitung jumlah komponen per kriteria ===
function calculateComponentsPerCriteria() {
  // Ambil data dari Laravel
  const components = @json($evalcomponents);

  // Hitung per criteria_id
  const counts = {};
  components.forEach(c => {
    if (!counts[c.criteria_id]) {
      counts[c.criteria_id] = 0;
    }
    counts[c.criteria_id]++;
  });

  // Tampilkan ke UI kalau mau
  Object.keys(counts).forEach(criteriaId => {
    const el = document.getElementById(`criteria-count-${criteriaId}`);
    if (el) {
      el.textContent = `${counts[criteriaId]} komponen`;
    }
  });
}

// Jalankan fungsi
calculateTotalPercentage();
calculateComponentsPerCriteria();
</script>

</x-app-layout>
