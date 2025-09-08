<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    use WithoutModelEvents;
    public function run(): void
    {
      $this->call([
        RootAdminSeeder::class,
        CriteriaSeeder::class,
        TeacherSeeder::class
      ]);
    }
}
