<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class RootAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         if (!User::where('email', 'root@gmail.com')->exists()) {
            User::factory()->create([
                'name' => 'root',
                'email' => 'root@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
            ]);
        }
    }
}
