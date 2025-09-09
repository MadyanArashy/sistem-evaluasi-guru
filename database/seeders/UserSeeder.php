<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $users = [
        [
          'name' => 'Eval',
          'email' => 'eval@gmail.com',
          'password' => Hash::make('12345678'),
          'role' => 'evaluator',
          'teacher_id' => null
        ],
        [
          'name' => 'Adi',
          'email' => 'adi@gmail.com',
          'password' => Hash::make('12345678'),
          'role' => 'evaluator',
          'teacher_id' => null
        ],
        [
          'name' => 'Lita Lidya',
          'email' => 'litalidya@gmail.com',
          'password' => Hash::make('12345678'),
          'role' => 'guru',
          'teacher_id' => '1',
        ],
        [
          'name' => 'Taufiq',
          'email' => 'taufiq@gmail.com',
          'password' => Hash::make('12345678'),
          'role' => 'guru',
          'teacher_id' => '2',
        ],
        [
          'name' => 'Rusli',
          'email' => 'rusli@gmail.com',
          'password' => Hash::make('12345678'),
          'role' => 'guru',
          'teacher_id' => '3',
        ],
      ];

      foreach ($users as $user) {
        User::create($user);
      }
    }
}
