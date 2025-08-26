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
}
