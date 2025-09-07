<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
  protected $fillable = [
    'teacher_id',
    'component_id',
    'semester_id',
    'user_id',
    'score',
  ];

  public function teacher() {
    return $this->belongsTo(Teacher::class, 'teacher_id');
  }
  public function component() {
    return $this->belongsTo(EvalComponent::class, 'component_id');
  }
  public function semester() {
    return $this->belongsTo(Semester::class, 'semester_id');
  }
  public function user() {
    return $this->belongsTo(User::class, 'user_id');
  }
}
