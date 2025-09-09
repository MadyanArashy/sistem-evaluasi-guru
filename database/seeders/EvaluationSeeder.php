<?php

namespace Database\Seeders;

use App\Models\EvalComponent;
use App\Models\Evaluation;
use Illuminate\Database\Seeder;

class EvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $evalcomponents = EvalComponent::all();

      $now = now();
      $evaluations = [];

      foreach ($evalcomponents as $component) {
        $evaluations[] = [
          'teacher_id'   => 1,
          'user_id'      => 2,
          'score'        => 40,
          'semester_id'  => 1,
          'component_id' => $component->id,
          'created_at'   => $now,
          'updated_at'   => $now,
        ];
      }

      Evaluation::insert($evaluations);
    }
}
