<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $teachers = [
        [
          "name" => "Lita Lidya",
          "degree" => "S.Kom",
          "subject" => "Produktif RPL",
        ],
        [
          "name" => "M. Taufiq Aziz",
          "degree" => "M.Pd.I",
          "subject" => "Pendidikan Agama Islam",
        ],
        [
          "name" => "Rusli",
          "degree" => "S.Si",
          "subject" => "Matematika",
        ],
      ];

      foreach($teachers as $teacher) {
        Teacher::create($teacher);
      }
    }
}
