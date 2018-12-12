<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Authenticated
{
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */
    public function handle($request, Closure $next)
    {
        return app(Authenticate::class)->handle($request, function ($request) use ($next) {
            $id = Auth::user()->id;
            $banned = DB::select("SELECT banned from users where id={$id}");
            if ($banned[0]->banned) {
                return redirect()->route('error', ['id' => 8]);
            } else {
                return $next($request);
            }
        });
    }
}
