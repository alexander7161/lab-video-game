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
        return view('index', ['games' => $games]);
    }

       /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function getGame(string $id)
    {
        if(ctype_digit($id)) {
            $game = DB::select("select * from game where id={$id}");
            return view('game', ['game' => $game]);    
        } else {
            return view('game', ['game' => array()]);    
        }
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