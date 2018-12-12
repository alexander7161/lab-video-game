<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\RulesController;

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

        $violations = DB::select("SELECT * from currentviolations where count>=(SELECT ruleviolimitperperiod FROM rules)");
        if (sizeof($violations)>0) {
            foreach ($violations as $v) {
                UserController::banUserById($v->iduser);
                DB::table('violations')->where('iduser', $v->iduser)->delete();
            }
        }

        $expiredbans = DB::select("SELECT * from bannedmembers where datebanned<NOW()-(SELECT banperiod FROM rules)");
        if (sizeof($expiredbans)>0) {
            foreach ($expiredbans as $b) {
                UserController::unBanUserById($b->iduser);
            }
        }


        return $next($request);
    }
}
