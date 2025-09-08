<?php

namespace Database\Seeders;

use App\Models\Criteria;
use Illuminate\Database\Seeder;

class CriteriaSeeder extends Seeder
{
  public function run(): void
    {
      Criteria::insert([
        [
          "name" => "Pedagogik",
          "weight" => 40,
          "style" => "linear-gradient(to bottom right, #4ade80, #22c55e)",
          "icon" => "fa-solid fa-chalkboard-user",
          "description" => "Kemampuan mengelola pembelajaran peserta didik"
        ],
        [
          "name" => "Profesional",
          "weight" => 30,
          "style" => "linear-gradient(to bottom right, #a78bfa, #8b5cf6)",
          "icon" => "fa-solid fa-briefcase",
          "description" => "Kemampuan penguasaan materi pembelajaran secara luas dan mendalam"
        ],
        [
          "name" => "Kepribadian",
          "weight" => 20,
          "style" => "linear-gradient(to bottom right, #fb923c, #f97316)",
          "icon" => "fa-solid fa-user-shield",
          "description" => "Kepribadian yang mantap, stabil, dewasa, arif, dan berwibawa"
        ],
        [
          "name" => "Sosial",
          "weight" => 10,
          "style" => "linear-gradient(to bottom right, #60a5fa, #3b82f6)",
          "icon" => "fa-solid fa-users",
          "description" => "Kemampuan pendidik berkomunikasi dan bergaul secara efektif"
        ],
      ]);
    }
}
