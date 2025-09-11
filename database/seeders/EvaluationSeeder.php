<?php

namespace Database\Seeders;

use App\Models\EvalComponent;
use App\Models\Evaluation;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class EvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $evalcomponents = EvalComponent::all();
      $teachers = Teacher::all();

      $now = now();
      $evaluations = [];
      foreach($teachers as $teacher) {
        foreach ($evalcomponents as $component) {
          $evaluations[] = [
            'teacher_id'   => $teacher->id,
            'user_id'      => 2,
            'score'        => rand(35, 50),
            'semester_id'  => 1,
            'component_id' => $component->id,
            'created_at'   => $now,
            'updated_at'   => $now,
          ];
        }
      }

      Evaluation::insert($evaluations);
    }
}
