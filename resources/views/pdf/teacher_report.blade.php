<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Evaluasi Guru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #2563eb;
            margin-bottom: 10px;
        }
        .teacher-info {
            margin-bottom: 20px;
        }
        .teacher-info h2 {
            color: #1f2937;
            margin-bottom: 5px;
        }
        .teacher-info p {
            margin: 2px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .criteria-header {
            background-color: #e5e7eb !important;
            font-weight: bold;
        }
        .score {
            text-align: center;
        }
        .overall-score {
            text-align: center;
            margin-top: 30px;
            padding: 20px;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
        }
        .overall-score h3 {
            color: #2563eb;
            margin-bottom: 10px;
        }
        .score-value {
            font-size: 24px;
            font-weight: bold;
            color: #065f46;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Evaluasi Guru</h1>
        <p>Sistem Evaluasi Guru</p>
    </div>

    <div class="teacher-info">
        <h2>{{ $teacher->name }} {{ $teacher->degree }}</h2>
        <p><strong>Mata Pelajaran:</strong> {{ $teacher->subject }}</p>
        @if($semester)
        <p><strong>Semester:</strong> {{ $semester->semester == 1 ? 'Ganjil' : ($semester->semester == 2 ? 'Genap' : 'Unknown') }} - {{ $semester->tahun_ajaran }}</p>
        @endif
        <p><strong>Tanggal Laporan:</strong> {{ date('d-m-Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Komponen</th>
                <th style="text-align: center;">Skor</th>
                <th style="text-align: center;">Bobot (%)</th>
                <th style="text-align: center;">Kriteria</th>
            </tr>
        </thead>
        <tbody>
            @php
            $groupedComponents = $evalcomponents
                ->sortBy('criteria_id')
                ->groupBy('criteria_id')
                ->sortKeys()
                ->map(function ($group) {
                    return $group->sortBy('criteria_id');
                });
            $no = 1;
            @endphp

            @foreach($groupedComponents as $criteriaId => $evalcomponentsGroup)
              @php
                $criteria = $evalcomponentsGroup->first()->criteria;
              @endphp

              <!-- Criteria Row -->
              <tr class="criteria-header">
                <td colspan="5">{{ $criteria->name }}</td>
              </tr>

              <!-- Components under this criteria -->
              @foreach($evalcomponentsGroup as $data)
              @php
                $criteria = \App\Models\Criteria::find($data->criteria_id);
              @endphp
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>
                    <strong>{{ $data->name }}</strong><br>
                    <small>{{ $data->description }}</small>
                  </td>
                  <td class="score">
                    {{ number_format(\App\Models\Evaluation::where('component_id', $data->id)->where('teacher_id', $teacher->id)->latest()->first()?->score / 10, 1) ?? '-' }}/5.0
                  </td>
                  <td class="score">{{ $data->weight }}%</td>
                  @if($loop->first)
                    <td class="score" rowspan="{{ count($evalcomponentsGroup) }}">{{ $criteria->weight }}</td>
                  @endif
                </tr>
              @endforeach
            @endforeach
        </tbody>
    </table>

    <div class="overall-score">
        <h3>Skor Evaluasi Keseluruhan</h3>
        <div class="score-value">{{ $score }}</div>
        <p>Kategori: Sangat Baik</p>
    </div>
</body>
</html>
