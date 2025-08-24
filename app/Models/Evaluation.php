<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
  protected $fillable = [
    'teacher_id',
    'component_id',
    'user_id',
    'score',
  ];
}
