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
        [
          "name" => "Citra Annisa",
          "degree" => "S.Hum",
          "subject" => "Pendidikan Pancasila",
        ],
        [
          "name" => "Eva Hariani",
          "degree" => "S.S",
          "subject" => "Bahasa Indonesia",
        ],
        [
          "name" => "Aditya Rahmadian Pamungkas",
          "degree" => "S.Sn",
          "subject" => "Produktif DKV",
        ],
        [
          "name" => "Deby Rahmawati",
          "degree" => "M.Hum",
          "subject" => "Bahasa Inggris",
        ],
        [
          "name" => "Dede Jamaludin",
          "degree" => "S.Pd",
          "subject" => "Bahasa Sunda",
        ],
        [
          "name" => "Prasetyo Laksono",
          "degree" => "S.Kom",
          "subject" => "Produktif TKJ",
        ],
        [
          "name" => "Triana",
          "degree" => "S.Pd",
          "subject" => "Pendidikan Pancasila",
        ],
        [
          "name" => "Sevira Rahmawati",
          "degree" => "S.Pd",
          "subject" => "Sejarah",
        ],
        [
          "name" => "Supriyadi",
          "degree" => "S.Pd",
          "subject" => "PJOK",
        ],
        [
          "name" => "Rafli Maulana",
          "degree" => "S.Kom",
          "subject" => "Produktif RPL",
        ],
        [
          "name" => "Wira Mahardika",
          "degree" => "S.Ds, M.M",
          "subject" => "Produktif DKV",
        ],
      ];

      foreach($teachers as $teacher) {
        Teacher::create($teacher);
      }
    }
}
