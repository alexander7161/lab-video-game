<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Log;

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

    public function toggleVolunteer($user)
    {
        Log::debug($user->id);
        if(ctype_digit($user->id)) {
            print("hello");
            DB::table('users')
            ->where('id', $user->id)
            ->update(['volunteer' => !$user->volunteer]);  
        }
    }
}