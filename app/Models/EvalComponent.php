<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvalComponent extends Model
{
    protected $fillable = [
        "name",
        "criteria_id",
        "weight",
        "description",
    ];

    public function criteria()
  {
    return $this->belongsTo(Criteria::class, 'criteria_id');
  }

}
