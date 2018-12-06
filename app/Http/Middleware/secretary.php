<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Secretary
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
        return app(Authenticated::class)->handle($request, function ($request) use ($next) {
            $id = Auth::user()->id;
            $secretary = DB::select("select * from user_roles where iduser={$id} and idrole=1 LIMIT 1");
            if (sizeof($secretary)>0) {
                return $next($request);
            } else {
                return redirect()->route('error', ['id' => 4]);
            }
        });
    }
}
