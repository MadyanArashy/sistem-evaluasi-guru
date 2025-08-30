<?php

namespace App\Services;

use App\Models\Activity;

class ActivityLogger
{
  public static function log(string $name, string $description, string $type = 'other', string $user_id)
  {
    Activity::create([
      'name'        => $name,
      'description' => $description,
      'type'        => $type,
      'user_id'     => $user_id,
    ]);
  }
}
