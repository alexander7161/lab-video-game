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
        if(ctype_digit($id) &&(Auth::user()->volunteer || $id ==Auth::user()->id)) {
        $user = DB::select("select * from users where id={$id}");
        return view('accountPage', ['user' => $user]); }
        else {
            return redirect()->route('error', ['id' => 0]);
        }
    }

    public function getCurrentUser()
    {
        $id = Auth::user()->id;
        $user = DB::select("select * from users where id={$id}");
        return view('accountPage', ['user' => $user]);
    }

    public function setVolunteer(Request $request)
    {
        $data = $request->all()['data'];
        if(isset($data["id"]) && ctype_digit($data["id"]) && Auth::user()->id !=$data["id"]) {
            print($data['volunteer']);
            DB::table('users')
            ->where('id', $data["id"])  // find your user by their email
            ->limit(1)  // optional - to ensure only one record is updated.
            ->update(array('volunteer' => !$data['volunteer']));  // update the record in the DB. 
            return redirect()->route('members');
        }
    }
}