<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Log;

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
        $games = DB::select("SELECT game.id, name, startdate, enddate, idmember, (CASE
        WHEN idmember is not null and enddate is null THEN
        false
        ELSE
        true
        END) as isavailable
FROM 
game
LEFT JOIN
    (select * from rentals where enddate is null) currentrentals
ON (game.id = currentrentals.idgame)");
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
        if (ctype_digit($id)) {
            $game = DB::select("select * from game where id={$id}");
            $renting = DB::select("select idmember, startdate, enddate, users.name as username from rentals inner join game on rentals.idgame=game.id inner join  users on rentals.idmember=users.id where rentals.idgame={$id} and enddate is null ");
            if (sizeof($game) > 0) {
                $data = [
                    'game' => $game[0],
                    'rents' => $renting
                ];
                return view('game', ['data' => $data]);
            } else {
                return redirect()->route('error', ['id' => 3]);
            }
        } else {
            return redirect()->route('error', ['id' => 3]);
        }
    }

    public function newGame()
    {
        if (Auth::user() && Auth::user()->volunteer) {
            return view('newGame');
        } else {
            return redirect()->route('error', ['id' => 1]);
        }
    }

    public function editGameView(string $id)
    {
        if (Auth::user() && Auth::user()->volunteer) {
            $game = DB::select("select * from game where id={$id}");
            if (sizeof($game) > 0) {
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

        // Log::info(print_r($data));

        Game::create([
        'name' => $data['name'],
        'releaseyear'=> $data['releaseyear'],
        'type'=> $data['type'],
        'description'=> $data['description'],
        'platform'=> $data['platform'],
        'rating'=> $data['rating'],
        'imageurl'=> $data['imageurl']
    ]);
        return redirect()->route('index');
    }

    public function deleteGame($id)
    {
        DB::update("UPDATE rentals set enddate=now() where idgame={$id}"); // End all rentals with game to delete.
        Game::destroy($id);
        return redirect()->route('index');
    }

    public function editGame(Request $request)
    {
        $data = $request->all();
        $game = Game::find($data['id']);

        
        // Log::info(print_r($data));
        $game->fill([
            'name' => $data['name'],
            'releaseyear'=> $data['releaseyear'],
            'type'=> $data['type'],
            'description'=> $data['description'],
            'platform'=> $data['platform'],
            'rating'=> $data['rating'],
            'imageurl'=> $data['imageurl']
        ]);

        $game->save();

        return redirect()->route('index');
    }
}
