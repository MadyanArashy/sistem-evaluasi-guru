<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        "name",
        "degree",
        "subject",
    ];

    /**
     * Get the users associated with the teacher.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
