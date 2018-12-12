<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RentController;

class Rules
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
        $overduerentals = DB::select("SELECT * from currentrentals where duedate<now()");
        if (sizeof($overduerentals)>0) {
            foreach ($overduerentals as $rental) {
                UserController::createViolation($rental->iduser);
                RentController::deleteRentById($rental->rentalid);
            }
        }
        return $next($request);
    }
}
