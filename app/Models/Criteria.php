<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    protected $fillable = [
    'name',
    'description',
    'weight',
    'icon',
    'style',
    ];

    public function components()
  {
    return $this->hasMany(EvalComponent::class, 'criteria_id');
  }
}
