<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Volunteer
{
    public function handle($request, Closure $next)
{
     if (Auth::user() &&  Auth::user()->volunteer) {
            return $next($request);
     }
     return redirect()->route('error', ['id' => 4]);
    }
}
