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
        <!-- Semester Table -->
        @include('partials.semester_table', ["semesters" => $semesters])

        <!-- User Table -->
        @include('partials.user_table', ["users" => $users])

        <!-- Kriteria Table -->
        @include('partials.criteria_table', ["criterias" => $criterias])

        <!-- Komponen Table -->
        @include('partials.component_table', ["evalcomponents" => $evalcomponents])


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
