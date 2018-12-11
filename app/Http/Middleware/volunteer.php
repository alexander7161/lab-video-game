<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Volunteer
{
    public function handle($request, Closure $next)
    {
        return app(Authenticated::class)->handle($request, function ($request) use ($next) {
            $id = Auth::user()->id;
            $volunteer = DB::select("select * from users where id={$id} and (idrole=1 or idrole=2)");
            if (sizeof($volunteer)>0) {
                return $next($request);
            } else {
                return redirect()->route('error', ['id' => 4]);
            }
        });
    }
}
