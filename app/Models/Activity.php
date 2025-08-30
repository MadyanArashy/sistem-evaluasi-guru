<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
  protected $fillable = [
    'name',
    'description',
    'type',
    'user_id',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
