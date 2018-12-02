<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Log;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function getUsers()
    {
        $users = DB::select('select * from users');
        sort($users);
        return view('memberList', ['users' => $users]);
    }

    public function getUser($id)
    {
        Log::info($id);
        if (ctype_digit($id) && (Auth::user()->volunteer || $id == Auth::user()->id)) {
            return self::getUserById($id);
        } else {
            return redirect()->route('error', ['id' => 0]);
        }
    }

    private function getUserById($id)
    {
        $user = DB::select("select * from users where id={$id}");
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
            // print($data['volunteer']);
            DB::table('users')
            ->where('id', $data["id"])  // find your user by their email
            ->limit(1)  // optional - to ensure only one record is updated.
            ->update(array('volunteer' => !$data['volunteer']));  // update the record in the DB.
            return redirect()->route('members');
        } else {
            return redirect()->route(
                'error'
            // ['id' => 0]
        );
        }
    }
}
