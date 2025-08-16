<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class GuruOnly
{
  public function handle($request, Closure $next)
  {
    if (Auth::check() && Auth::user()->role === 'guru') {
      return $next($request);
    }

    abort(403, 'Unauthorized.');
  }
}
