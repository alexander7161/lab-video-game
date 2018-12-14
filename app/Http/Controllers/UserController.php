<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Log;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private function getVolunteer($id)
    {
        $volunteer = DB::select("select * from users where id={$id} and (idrole=1 or idrole=2)");
        return (sizeof($volunteer)>0);
    }

    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function getUsers()
    {
        $users = DB::select('SELECT id, name, email, created_at, updated_at, volunteer, secretary, banned, currentrentals
        from currentusers');
        sort($users);
        usort($users, function ($item1, $item2) {
            return $item2->secretary <=> $item1->secretary;
        });
        usort($users, function ($item1, $item2) {
            return $item2->volunteer <=> $item1->volunteer;
        });
        return view('memberList', ['users' => $users]);
    }

    public function getUser($id)
    {
        if (ctype_digit($id) && (self::getVolunteer(Auth::user()->id) || $id == Auth::user()->id)) {
            return self::getUserById($id);
        } else {
            return redirect()->route('error', ['id' => 0]);
        }
    }
    
    private function getUserById($id)
    {
        $user = DB::select("SELECT users.id as id, name, email, created_at, updated_at,  
        (CASE WHEN isbanned is null THEN false ELSE true END) as banned,
        (CASE WHEN idrole is null 
        THEN false ELSE true END) as volunteer,
        (CASE WHEN idrole = 2
        THEN true ELSE false END) as secretary,
        (CASE WHEN viocount is null
        THEN 0 ELSE vioCount END) as violations
        from users
        left  outer join (select iduser, count(*) as vioCount from violations group by iduser) violations on users.id=violations.iduser
        left  outer join (select iduser, count(*) as isbanned from bannedmembers group by iduser) bannedmembers on users.id=bannedmembers.iduser
        where users.id={$id}")[0];
        $games = DB::select("SELECT (CASE
        WHEN iduser is not null and enddate is null THEN
        true
        ELSE
        false
        END) as currentlyBorrowed, game.name as name, startdate, enddate, extensions, idgame, (CASE WHEN enddate is not null THEN null ELSE startdate+(SELECT rentalperiod FROM rules)+(extensions || ' weeks')::interval END) as duedate from rentals inner join game on rentals.idgame=game.id where rentals.iduser={$id}");
        $violations = DB::select("SELECT violationdate as date, reason, id from violations where iduser={$id}");
        $ban = DB::select("SELECT datebanned, datebanned+(SELECT banperiod FROM rules) as banenddate from bannedmembers where iduser={$id}");
        return view('accountPage.index', compact('games', 'user', 'violations', 'ban'));
    }

    public function getCurrentUser()
    {
        return self::getUserById(Auth::user()->id);
    }

    public function setVolunteer(Request $request)
    {
        $data = $request->all()['data'];
        if (isset($data["id"]) && ctype_digit($data["id"]) && Auth::user()->id !=$data["id"]) {
            if (!$data['volunteer']) {
                DB::table('users')->where('id', $data["id"])
                ->update(['idrole' => 1]);
                return redirect()->back();
            } else {
                DB::table('users')->where('id', $data["id"])
                ->update(['idrole' => null]);
                return redirect()->back();
            }
        } else {
            return redirect()->route(
                'error'
            // ['id' => 0]
        );
        }
    }

    public function makeSecretary(Request $request)
    {
        $data = $request->all()['data'];
        if (isset($data["id"]) && ctype_digit($data["id"]) && Auth::user()->id!=$data["id"]) {
            DB::table('users')->where('id', Auth::user()->id)
                ->update(['idrole' => 1]);
            DB::table('users')->where('id', $data["id"])
                ->update(['idrole' => 2]);
            return redirect()->back();
        } else {
            return redirect()->route(
                'error'
            // ['id' => 0]
        );
        }
    }

    public static function createViolation($id)
    {
        DB::table('violations')->insert(
            ['iduser' => $id, 'violationdate' => 'now()']
        );
        return redirect()->back();
    }

    public function removeViolation($id)
    {
        DB::table('violations')->where('id', $id)->delete();
        return redirect()->back();
    }

    public function banUser($id)
    {
        if (isset($id) && ctype_digit($id) && Auth::user()->id !=$id) {
            self::banUserById($id);
            return redirect()->back();
        } else {
            return redirect()->route(
                'error'
            // ['id' => 0]
        );
        }
    }

    public static function banUserById($id)
    {
        DB::table('bannedmembers')->insert(
            ['iduser' => $id, 'datebanned' => 'NOW()']
        );
    }

    public static function unBanUserById($id)
    {
        DB::table('bannedmembers')->where('iduser', $id)->delete();
    }

    public function unBanUser($id)
    {
        if (isset($id) && ctype_digit($id) && Auth::user()->id !=$id) {
            self::unBanUserById($id);
            return redirect()->back();
        } else {
            return redirect()->route(
                'error'
            // ['id' => 0]
        );
        }
    }
}
