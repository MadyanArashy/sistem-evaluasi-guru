<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
  protected $fillable = [
    'semester',
    'tahun_ajaran'
  ];

  public function evaluations()
  {
    return $this->hasMany(\App\Models\Evaluation::class, 'semester_id');
  }
}
