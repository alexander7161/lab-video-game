<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;

class GameController extends Controller
{
    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $query = "SELECT id, name, startdate, enddate, iduser, isavailable from currentgames";

        $filter = urldecode($request->query('filter'));
        $available = $request->query('available');
        if ($filter && $available=="only") {
            $query .= " where LOWER(name) like concat('%',LOWER('{$filter}'),'%') and isavailable=true";
        } elseif ($filter) {
            $query .= " where LOWER(name) like concat('%',LOWER('{$filter}'),'%')";
        } elseif ($available=="only") {
            $query .= " where isavailable=true";
        }

        $sort = $request->query('sort');
        if ($sort=="ASC"|| $sort=='DESC') {
            $query .= " order by name ${sort}";
        }
        $games = DB::select($query);
        return view('index', compact('games'));
    }

    /**
     * Show a list of all of the application's users.
     *
     * @return Response
     */
    public function getGame(string $id)
    {
        if (ctype_digit($id)) {
            $game = DB::select("SELECT * from game where id={$id}");
            $renting = DB::select("SELECT rentalid, iduser, startdate, enddate, username,
                                (CASE WHEN enddate is not null THEN null ELSE startdate+(SELECT rentalperiod FROM rules)+(extensions || ' weeks')::interval END) as duedate,
                                extensions
                                from currentrentals
                                where idgame={$id} and enddate is null ");
            $rentalhistory = DB::select("SELECT iduser, startdate, enddate, users.name as username, extensions, idgame
                                    from rentals 
                                    left outer join game 
                                    on rentals.idgame=game.id
                                    left outer join
                                    users
                                    on rentals.iduser=users.id
                                    where idgame={$id} and enddate is not null");
            usort($rentalhistory, function ($item1, $item2) {
                return strtotime($item2->startdate) <=> strtotime($item1->startdate);
            });
            if (sizeof($game) > 0) {
                $game = $game[0];
                return view('game.index', compact('game', 'renting', 'rentalhistory'));
            } else {
                return redirect()->route('error', ['id' => 3]);
            }
        } else {
            return redirect()->route('error', ['id' => 3]);
        }
    }

    public function editGameView(string $id)
    {
        $game = DB::select("SELECT * from game where id={$id}");
        $platforms = DB::select("SELECT unnest(enum_range(NULL::platform))");
        if (sizeof($game) > 0) {
            $game = $game[0];
            return view('editGame', compact('game', 'platforms'));
        } else {
            return redirect()->route('error', ['id' => 2]);
        }
    }

    public function newGameView()
    {
        $platforms = DB::select("SELECT unnest(enum_range(NULL::platform))");
        return view('newGame', compact('platforms'));
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
        'onplatform'=> $data['platform'],
        'rating'=> $data['rating'],
        'recommendedurl'=> $data['review'],
        ]);
        // Upload image directly in 'public/img/' with same name with game.
        $file = request()->file('image');
        $fileName = str_replace(' ', '', $request->name).'.jpg';
        $file->storeAs('img', $fileName, ['disk' => 'public']);

        return redirect()->route('index')->with('Success', 'Game added successfully...');
    }

    public function deleteGame(Request $request, $id)
    {
        $game = Game::find($id);
        $image_path = public_path().'/img/'.str_replace(' ', '', $game->name).'.jpg';
        unlink($image_path);
        DB::update("UPDATE rentals set enddate=now() where idgame={$id}"); // End all rentals with game to delete.
        Game::destroy($id);
        return redirect()->route('index');
    }

    public function markAsDamaged(Request $request, $id)
    {
        DB::update("UPDATE game set damaged = true where id={$id}");
        return redirect()->back();
    }

    public function markAsNotDamaged(Request $request, $id)
    {
        DB::update("UPDATE game set damaged = false where id={$id}");
        return redirect()->back();
    }

    public function editGame(Request $request)
    {
        $data = $request->all();
        $game = Game::find($data['id']);
        if (isset($data['image'])) {
            $image = $request->file('image');
            $filename = str_replace(' ', '', $game->name).'.jpg';
            ;
            $path = public_path('img/' . $filename);
            unlink($path);

            $file = request()->file('image');
            $fileName = str_replace(' ', '', $game->name).'.jpg';
            $file->storeAs('img', $fileName, ['disk' => 'public']);
        }

        
        // Log::info(print_r($data));
        $game->fill([
            'name' => $data['name'],
            'releaseyear'=> $data['releaseyear'],
            'type'=> $data['type'],
            'description'=> $data['description'],
            'onplatform'=> $data['platform'],
            'rating'=> $data['rating'],
            'recommendedurl'=> $data['review'],
        ]);


        $game->save();

        return redirect()->route('index')->with('Success', 'Game information updated successfully...');
    }
}
