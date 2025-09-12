<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        "name",
        "degree",
        "subject",
        "status"
    ];
    /**
     * Automatically set the teacher's status as Honor.
     */
    protected $attributes = [
        'status' => 'Guru Honor',
    ];

    /**
     * Get the users associated with the teacher.
     */
    public function users()
    {
        return $this->hasOne(User::class);
    }
}
