<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function store()
    {
        //return view('addressee_dtls')->with('adrs_dtls', $adrs);
        // print_r($request);
    }

    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function index()
    {
        $games = DB::select('select * from game');
        sort($games);
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
            if(sizeof($game) > 0) {
                return view('game', ['game' => $game[0]]);    
            } else {
                return redirect()->route('error', ['id' => 3]);
            }
        } else {
            return redirect()->route('error', ['id' => 3]);
        }
    }

    public function newGame()
    {
        if(Auth::user() && Auth::user()->volunteer) {
            return view('newGame');
        } else {
            return redirect()->route('error', ['id' => 1]);
        }  
    } 

    public function editGame(string $id)
    {

        if(Auth::user() && Auth::user()->volunteer) {
            $game = DB::select("select * from game where id={$id}");
            if(sizeof($game) > 0) {
                return view('editGame', ['game' => $game[0]]);
            } else {
                return redirect()->route('error', ['id' => 2]);
            }
        } else {
            return redirect()->route('error', ['id' => 2]);
        }  
    } 

    public function createGame(Request $request)
{
    $data = $request->all();

    Game::create([
        'name' => $data['name']
    ]);
    return redirect()->route('index');
}

public function deleteGame($id)
{
    Game::destroy($id);
    return redirect()->route('index');
}


}