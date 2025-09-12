<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $semesters = [
        [
          "semester" => "1",
          "tahun_ajaran" => "2024-2025",
        ],
        [
          "semester" => "2",
          "tahun_ajaran" => "2024-2025",
        ],
        [
          "semester" => "1",
          "tahun_ajaran" => "2025-2026",
        ],
        [
          "semester" => "2",
          "tahun_ajaran" => "2025-2026",
        ],
      ];
      foreach($semesters as $semester) {
        Semester::create($semester);
      }
    }
}
