<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class GameController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function index()
    {
        $games = DB::select('select * from game');
        info($games);

        return view('index', ['games' => $games]);
    }
/*
    * Create a new user instance after a valid registration.
    *
    * @param  array  $data
    * @return \App\User
    */
   protected function create(array $data)
   {
       return Game::create([
           'name' => $data['name'],
           'isavailable' => $data['isavailable']
       ]);
   }
}