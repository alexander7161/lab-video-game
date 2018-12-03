<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('volunteer', function () {
            if (auth()->check()) {
                $id = Auth::user()->id;
                $volunteer = DB::select("select * from user_roles where iduser={$id}");
                if (sizeof($volunteer)>0) {
                    return true;
                } else {
                    return false;
                }
            }
            return false;
        });

        Blade::if('member', function () {
            return auth()->check();
        });

        Blade::if('useridequals', function ($userid) {
            return auth()->check() && $userid==Auth::id();
        });

        Blade::if('secretary', function () {
            if (auth()->check()) {
                $id = Auth::user()->id;
                $secretary = DB::select("select * from user_roles where iduser={$id} and idrole=1 LIMIT 1");
                return (sizeof($secretary)>0);
            }
            return false;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
