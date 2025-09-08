@php
  use App\Models\Semester;
@endphp
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

    .score-display {
      background: linear-gradient(135deg, #f8fafc, #e2e8f0);
      padding: 8px 16px;
      border-radius: 16px;
      font-weight: 700;
      font-size: 1rem;
      color: #1f2937;
      border: 2px solid transparent;
      background-clip: padding-box;
      position: relative;
    }

    .score-excellent { border-color: #10b981; color: #065f46; background: linear-gradient(135deg, #d1fae5, #a7f3d0); }
    .score-good { border-color: #3b82f6; color: #1e40af; background: linear-gradient(135deg, #dbeafe, #93c5fd); }
    .score-fair { border-color: #f59e0b; color: #92400e; background: linear-gradient(135deg, #fef3c7, #fcd34d); }
    .score-poor { border-color: #ef4444; color: #991b1b; background: linear-gradient(135deg, #fee2e2, #fca5a5); }
  </style>

  <div class="mx-auto px-2 py-12 relative z-10">
    <div class="content-card">
      <!-- Teacher Header -->
      <div class="flex flex-col md:flex-row md:justify-between md:items-center">
        <div class="flex items-center mb-8 space-x-8">
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
        <div>
          <a href="{{ route('teacher.show', ["id" => $teacher->id]) }}" class="action-btn detail-btn text-lg">
            <i class="fa-solid fa-arrow-up-right-from-square"></i></i>Lihat Guru
          </a>
        </div>
      </div>

      <!-- Success Message -->
      @if(session('success'))
        @include('partials.success')
      @endif

      <!-- Evaluation Components Table -->
      <div class="table-container overflow-auto xl:overflow-hidden">
        <table class="min-w-full" id="guruTable">
          <thead class="table-header">
            <tr>
              <th class="text-left">No</th>
              <th class="text-left">Komponen</th>
              <th class="text-center">Bobot</th>
              <th class="text-center">Skor (1-5)</th>
            </tr>
          </thead>
          <tbody>
            @php
            $groupedComponents = $evalcomponents
                ->sortBy('criteria_id')
                ->groupBy('criteria_id')
                ->sortKeys()
                ->map(fn ($group) => $group->sortBy('criteria_id'));
            @endphp

            @foreach($groupedComponents as $criteriaId => $evalcomponentsGroup)
              @php
                $criteria = $evalcomponentsGroup->first()->criteria;
                preg_match_all('/#([0-9a-fA-F]{6})/', $criteria->style, $matches);
                $primaryColor = $matches[0][0] ?? '#000000';
                $secondaryColor = $matches[0][1] ?? '#000000';
                [$r, $g, $b] = sscanf($primaryColor, "#%02x%02x%02x");
                $bgColor = "rgba($r, $g, $b, 0.1)";
                $no = 1;
              @endphp

              <!-- Criteria Row with Weight Display -->
              <tr class="bg-gray-100">
                <td colspan="5" class="font-bold">
                  <div class="py-2 px-3 font-semibold text-center flex justify-between items-center"
                    style="color: {{ $secondaryColor }}; background-color: {{ $bgColor }};">
                    <span>{{ $criteria->name }}</span>
                    <span class="text-sm bg-white px-2 py-1 rounded" style="color: {{ $primaryColor }};">
                      Bobot: {{ $criteria->weight }}%
                    </span>
                  </div>
                </td>
              </tr>

              <!-- Components under this criteria -->
              @foreach($evalcomponentsGroup as $data)
                <tr class="table-row">
                  <td class="p-6">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center text-white font-bold text-sm"
                      style="background: {{ $primaryColor }};">
                      {{ $no++ }}
                    </div>
                  </td>
                  <td class="p-6">
                    <h4 class="component-name">{{ $data->name }}</h4>
                    <p class="component-description text-gray-500 text-sm">{{ $data->description }}</p>
                  </td>
                  <td class="p-6 text-center">
                    <div class="weight-badge px-3 py-1 rounded-lg font-semibold text-white" style="background: {{ $criteria->style }}">
                      <i class="fas fa-percentage"></i>
                      <span class="evalWeight">{{ $data->weight }}</span>%
                    </div>
                  </td>
                  <td class="p-6 text-center">
                    <form action="{{ route('evaluation.store') }}" method="POST" class="evaluation-form">
                      @csrf
                      <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
                      <input type="hidden" name="component_id" value="{{ $data->id }}">
                      <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                      <input type="hidden" name="semester_id" class="semester-input" value="">
                      <input type="number"
                        step="0.1"
                        min="1"
                        max="5"
                        class="evaluation-input border rounded p-2"
                        data-teacher="{{ $teacher->id }}"
                        data-component="{{ $data->id }}"
                        data-user="{{ auth()->user()->id }}"
                        data-criteria="{{ $criteria->id }}"
                        data-criteria-weight="{{ $criteria->weight }}"
                        name="score"
                        required
                      >

                    </form>
                  </td>
                </tr>
              @endforeach
            @endforeach
          </tbody>
        </table>
      </div>

      <!-- Add Submit All button -->
      <div class="flex flex-col justify-center mt-6 items-center gap-4">
        <!-- Semester Selection Section -->
        <div class="semester-section">
          <label class="semester-label">
            <i class="fas fa-calendar-alt text-blue-600"></i>
            Pilih Semester Evaluasi
          </label>
          <select id="semesterSelect" class="semester-dropdown" required>
            <option value="" disabled selected>-- Pilih Semester --</option>
            @foreach(Semester::orderBy('tahun_ajaran', 'desc')->orderBy('semester', 'asc')->get() as $semester)
              <option value="{{ $semester->id }}">
                {{ $semester->semester == 1 ? 'Ganjil' : 'Genap' }}, {{ $semester->tahun_ajaran }}
              </option>
            @endforeach
          </select>
          <p class="text-sm text-gray-600 mt-2">
            <i class="fas fa-info-circle mr-1"></i>
            Pilih semester untuk melakukan evaluasi guru
          </p>
        </div>
        <button id="submitAll" class="action-btn gradient-element text-white px-6 py-3 rounded-lg shadow-md">
          <i class="fa-solid fa-paper-plane mr-2"></i> Submit Semua
        </button>
      </div>

      <!-- Overall Score Section -->
      <div class="mt-8 p-8 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl border-2 border-blue-200">
        <div class="text-center">
          <h3 class="text-2xl font-bold gradient-text mb-4">Skor Evaluasi Keseluruhan</h3>
          <div class="flex justify-center items-center space-x-8">
            <div class="text-center">
              <p class="text-sm text-gray-600 mb-2">Total Skor</p>
              <div class="text-4xl font-bold text-blue-600" id="overallScore">0.00</div>
            </div>
            <div class="text-center">
              <p class="text-sm text-gray-600 mb-2">Kategori</p>
              <div class="px-6 py-3 bg-gray-400 text-white rounded-full font-bold text-lg" id="scoreCategory">Belum Dinilai</div>
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

  <!-- Updated JavaScript -->
  <script>
    function calculateScore() {
        // Group evaluations by criteria
        const criteriaGroups = {};
        const inputs = document.querySelectorAll(".evaluation-input");

        inputs.forEach((input) => {
            const score = parseFloat(input.value) || 0;
            const criteriaId = input.dataset.criteria;
            const componentWeight = parseFloat(input.closest('tr').querySelector('.evalWeight').textContent) || 0;
            const criteriaWeight = parseFloat(input.dataset.criteriaWeight) || 0;

            if (!criteriaGroups[criteriaId]) {
                criteriaGroups[criteriaId] = {
                    components: [],
                    criteriaWeight: criteriaWeight
                };
            }

            criteriaGroups[criteriaId].components.push({
                score: score,
                weight: componentWeight
            });
        });

        let finalScore = 0;

        // Calculate score for each criteria
        Object.values(criteriaGroups).forEach(criteria => {
            let criteriaWeightedSum = 0;
            let criteriaTotalWeight = 0;

            // Calculate weighted average within criteria
            criteria.components.forEach(component => {
                criteriaWeightedSum += component.score * component.weight;
                criteriaTotalWeight += component.weight;
            });

            // Normalize criteria score (0-5 scale)
            const criteriaScore = criteriaTotalWeight > 0 ?
                (criteriaWeightedSum / criteriaTotalWeight) : 0;

            // Apply criteria weight to overall score
            finalScore += (criteriaScore * criteria.criteriaWeight) / 100;
        });

        console.log("Final Score:", finalScore.toFixed(2));
        document.getElementById("overallScore").textContent = finalScore.toFixed(2);

        // Update category based on score
        updateScoreCategory(finalScore);
    }

    function updateScoreCategory(score) {
        const categoryElement = document.getElementById('scoreCategory');
        let category = '';
        let categoryClass = '';

        if (score >= 4.0) {
            category = 'Sangat Baik';
            categoryClass = 'bg-green-500';
        } else if (score >= 3.0) {
            category = 'Baik';
            categoryClass = 'bg-blue-500';
        } else if (score >= 2.0) {
            category = 'Cukup';
            categoryClass = 'bg-yellow-500';
        } else if (score > 0) {
            category = 'Kurang';
            categoryClass = 'bg-red-500';
        } else {
            category = 'Belum Dinilai';
            categoryClass = 'bg-gray-400';
        }

        categoryElement.textContent = category;
        categoryElement.className = `px-6 py-3 ${categoryClass} text-white rounded-full font-bold text-lg`;
    }

    // Run when any evaluation input is typed
    document.addEventListener("keyup", function(e) {
        if (e.target.classList.contains("evaluation-input")) {
            calculateScore();
        }
    });

    document.addEventListener("DOMContentLoaded", () => {
        const inputs = document.querySelectorAll(".evaluation-input");
        const submitBtn = document.getElementById("submitAll");

        // Check empty inputs function
        function checkInputs() {
            let allFilled = true;
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    allFilled = false;
                    input.classList.remove('border-green-500', 'focus:border-green-500', 'focus:ring-green-500');
                    input.classList.add('border-indigo-400', 'focus:border-indigo-500', 'focus:ring-indigo-500');
                } else {
                    input.classList.remove('border-indigo-400', 'focus:border-indigo-500', 'focus:ring-indigo-500');
                    input.classList.add('border-green-500', 'focus:border-green-500', 'focus:ring-green-500');
                }
            });
            submitBtn.disabled = !allFilled;
        }

        // Initial check when page loads
        checkInputs();

        // Check whenever input changes
        inputs.forEach(input => {
            input.addEventListener("input", checkInputs);
        });

        // Submit All button
        submitBtn.addEventListener("click", () => {
            let evaluations = collectEvaluations();

            // Validate again before sending
            let hasEmpty = evaluations.some(e => e.score === "" || isNaN(e.score));
            if (hasEmpty) {
                alert("Harap isi semua nilai terlebih dahulu sebelum mengirim.");
                return;
            }

            fetch("/evaluate/all", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ evaluations })
            })
            .then(res => res.json())
            .then(data => {
                console.log("Success:", data);
                alert(data.message);
            })
            .catch(err => {
                console.error("Error:", err);
                alert("Terjadi kesalahan");
            });
        });

        // Collect input data
       function collectEvaluations() {
        let rows = document.querySelectorAll(".evaluation-input");
        let semesterId = document.getElementById("semesterSelect").value;
        let data = [];
        rows.forEach(row => {
          data.push({
            teacher_id: row.dataset.teacher,
            component_id: row.dataset.component,
            user_id: row.dataset.user,
            semester_id: semesterId, // 🔑 tambahkan ini
            score: row.value * 10
          });
        });
        return data;
      }

    });
    document.addEventListener("DOMContentLoaded", () => {
      const semesterSelect = document.getElementById("semesterSelect");

      semesterSelect.addEventListener("change", function() {
        const semesterId = this.value;
        document.querySelectorAll(".semester-input").forEach(input => {
          input.value = semesterId;
        });
      });

      // ... kode lain (checkInputs, submitAll, dsb)
    });

  </script>
</x-app-layout>
