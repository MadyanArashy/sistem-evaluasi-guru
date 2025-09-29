@php
  use App\Models\Criteria;
  use App\Models\Evaluation;
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

    .category-display {
      background: linear-gradient(135deg, #6366f1, #4f46e5);
      color: white;
      padding: 8px 16px;
      border-radius: 16px;
      font-weight: 600;
      font-size: 1rem;
      text-align: center;
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .all-score {
      background: linear-gradient(135deg, #2563eb, #0ea5e9);
      color: white;
      padding: 8px 16px;
      border-radius: 16px;
      font-weight: 700;
      font-size: 1rem;
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
            <p class="component-description">
              {{ $teacher->status }}
            </p>
          </div>
        </div>
        @if(auth()->check() && auth()->user()->role === 'evaluator')
        <div>
          <a href="{{ route('evaluation.create', ["id" => $teacher->id]) }}" class="action-btn detail-btn text-lg">
            <i class="fa-solid fa-arrow-up-right-from-square"></i></i>Evaluasi Baru
          </a>
        </div>
        @endif
      </div>

      <!-- Success Message -->
      @if(session('success'))
        @include('partials.success')
      @endif

      <div class="table-container overflow-auto 2xl:overflow-hidden">
        <table class="min-w-full" id="guruTable">
          <thead class="table-header">
            <tr>
              <th class="text-left">No</th>
              <th class="text-left">Komponen</th>
              <th class="text-center">Skor</th>
              <th class="text-center">Kategori</th>
              <th class="text-center">All</th>
            </tr>
          </thead>
          <tbody>
            @php
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
            @endphp

            @foreach($groupedComponents as $criteriaId => $evalcomponentsGroup)
              @php
                $criteria = $evalcomponentsGroup->first()->criteria;

                // Extract first and second color from style
                preg_match_all('/#([0-9a-fA-F]{6})/', $criteria->style, $matches);

                $primaryColor = $matches[0][0] ?? '#000000';
                $secondaryColor = $matches[0][1] ?? '#000000';

                // Create bg color from primaryColor and apply 0.1 opacity
                list($r, $g, $b) = sscanf($primaryColor, "#%02x%02x%02x");
                $bgColor = "rgba($r, $g, $b, 0.1)";
                $no = 1
              @endphp

              <!-- Criteria Row -->
              <tr class="bg-gray-100">
                <td colspan="5" class="font-bold">
                  <div class="py-2 px-3 font-semibold text-center"
                    style="color: {{ $secondaryColor }}; background-color: {{ $bgColor }};">
                    {{ $criteria->name }}
                  </div>
                </td>
              </tr>

              <!-- Components under this criteria -->
              @foreach($evalcomponentsGroup as $data)
              @php
                $criteria = Criteria::find($data->criteria_id);
              @endphp
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
                    <div class="score-badge">
                      <i class="fas fa-star mr-1"></i>
                      <span class="evalScore">
                        @php
                          $latestSemester = collect($semesterScores)->keys()->first();
                          $evaluation = $latestSemester ? Evaluation::where('component_id', $data->id)
                            ->where('teacher_id', $teacher->id)
                            ->where('semester_id', $latestSemester)
                            ->latest()->first() : null;
                        @endphp
                        {{ $evaluation ? number_format($evaluation->score / 10, 1) : '-' }}
                      </span>/5.0
                    </div>
                  </td>
                  <td class="p-6 text-center">
                    <div class="weight-badge px-3 py-1 rounded-lg font-semibold text-white" style="background: {{ $criteria->style }}">
                      <i class="fas fa-percentage"></i>
                      <span class="evalWeight">{{ $data->weight }}</span>%
                    </div>
                  </td>
                  @if($loop->first)
                    <td class="p-6 text-center entire-column" rowspan="{{ count($evalcomponentsGroup) }}">
                      <div class="all-score inline-block">{{ $criteria->weight }}</div>
                    </td>
                  @endif
                </tr>
              @endforeach
            @endforeach
          </tbody>
        </table>
      </div>

      <!-- Semester Scores History -->
      @if(count($semesterScores) > 0)
      <div class="mt-8 p-8 bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl border-2 border-purple-200">
        <div class="text-center mb-6">
          <h3 class="text-2xl font-bold gradient-text">Riwayat Penilaian per Semester</h3>
          <p class="text-gray-600 mt-2">Data lengkap dari semester pertama bekerja hingga sekarang</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
          @foreach($semesterScores as $semesterId => $semesterData)
          <div class="bg-white p-6 rounded-xl shadow-lg border-2 border-purple-100 hover:shadow-xl transition-shadow duration-300">
            <div class="text-center">
              <div class="text-sm text-gray-500 mb-1">{{ $semesterData['tahun_ajaran'] }}</div>
              <div class="text-lg font-bold text-purple-600 mb-3">{{ $semesterData['semester_name'] }}</div>
              <div class="text-3xl font-bold text-purple-700 mb-2">{{ $semesterData['score'] }}</div>
              <div class="text-xs text-gray-500 mb-4">Skor Evaluasi</div>
              <div class="flex justify-center space-x-2">
                <a href="{{ route('teacher.semester', ['id' => $teacher->id, 'semester_id' => $semesterId]) }}" class="bg-purple-500 hover:bg-purple-600 text-white px-3 py-1 rounded text-sm">
                  <i class="fas fa-eye"></i> Lihat Detail
                </a>
                <a href="{{ route('teacher.report', ['id' => $teacher->id, 'semester_id' => $semesterId]) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm" target="_blank" rel="noopener noreferrer">
                  <i class="fas fa-print"></i> Cetak
                </a>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      @endif

      <!-- Overall Score Section -->
      <div class="mt-8 p-8 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl border-2 border-blue-200">
        <div class="text-center">
          <h3 class="text-2xl font-bold gradient-text mb-4">Skor Evaluasi Keseluruhan</h3>
          <div class="flex justify-center items-center space-x-8">
            <div class="text-center">
              <p class="text-sm text-gray-600 mb-2">Total Skor</p>
              <div class="text-4xl font-bold text-blue-600" id="overallScore">{{ $overallScore }}</div>
            </div>
            <div class="text-center">
              <p class="text-sm text-gray-600 mb-2">Kategori</p>
              <div class="px-6 py-3 bg-gray-400 text-white rounded-full font-bold text-lg" id="scoreCategory">Belum Dinilai</div>
            </div>
          </div>
        </div>
      </div>

     <!-- Action Buttons -->
      @if(auth()->check() && auth()->user()->role !== 'guru')
      <div class="flex justify-center space-x-4 mt-8">
        <!-- Promote to Guru Tetap Button -->
        @if(auth()->user()->role === 'evaluator' && $teacher->status === 'Calon Guru Tetap')
        <form action="{{ route('teacher.promote', ['id' => $teacher->id]) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin mempromosikan {{ $teacher->name }} menjadi Guru Tetap?')">
          @csrf
          @method('PUT')
          <button type="submit" class="promote-btn action-btn">
            <i class="fa-solid fa-star mr-2"></i>
            Promosikan ke Guru Tetap
          </button>
        </form>
        @endif
      </div>
      @endif
    </div>
  </div>

  <script>
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

  document.addEventListener("DOMContentLoaded", () => {
    updateScoreCategory({{ $overallScore }});
  })
  </script>
</x-app-layout>
