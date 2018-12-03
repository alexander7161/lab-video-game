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
        $volunteer = DB::select("select * from user_roles where iduser={$id}");
        return (sizeof($volunteer)>0);
    }

    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function getUsers()
    {
        $users = DB::select('select *, (CASE
        WHEN iduser is null THEN
        false
        ELSE
        true
        END) as volunteer, (CASE
        WHEN idrole = 1 THEN
        true
        ELSE
        false
        END) as secretary from users left join user_roles on users.id=iduser');
        sort($users);
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
        $user = DB::select("select name, email, created_at, updated_at, extensions, violations, firstviolation,latestviolation,banned,  (CASE
        WHEN iduser is null THEN
        false
        ELSE
        true
        END) as volunteer, (CASE
        WHEN idrole = 1 THEN
        true
        ELSE
        false
        END) as secretary from users left join user_roles on users.id=iduser where id={$id}");
        $rentedGames = DB::select("SELECT (CASE
        WHEN idmember is not null and enddate is null THEN
        true
        ELSE
        false
        END) as currentlyBorrowed, game.name as name, startdate, enddate from rentals inner join game on rentals.idgame=game.id where rentals.idmember={$id}");

        $data = [
            'user'  => $user,
            'games'   => $rentedGames
        ];
        return view('accountPage', ['data' => $data]);
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
                DB::table('user_roles')->insert(
                    ['iduser' => $data["id"], 'idrole' => 2]
                );
                return redirect()->route('members');
            } else {
                DB::table('user_roles')->where('iduser', '=', $data["id"])->delete();
                return redirect()->route('members');
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
            DB::table('user_roles')->insert(
                    ['iduser' => $data["id"], 'idrole' => 1]
                );
            DB::table('user_roles')
            ->where('iduser', Auth::user()->id)
            ->update(['idrole' => 2]);
            return redirect()->route('members');
        } else {
            return redirect()->route(
                'error'
            // ['id' => 0]
        );
        }
    }
}
