<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rent;
use Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\RulesController;

class RentController extends Controller
{
    public function createRent(Request $request)
    {
        $id =Auth::id();
        $rentedGames = DB::select("select * from rentals inner join game on rentals.idgame=game.id where rentals.idmember={$id} and enddate is null");
        if (sizeof($rentedGames)>=RulesController::getRentGameLimit()) {
            return redirect()->route('error', ['id' => 5]);
        }
        $data = $request->all()['data'];
        if (Auth::user()) {
            Rent::create([
                'idgame' => $data['idgame'],
                'idmember' => $id
            ]);
        }
        return redirect()->route('index');
    }

    public function deleteRent(Request $request)
    {
        $data = $request->all()['data'];
        $memberid = Auth::id();
        $id = $data['idgame'];
        $rentedGames = DB::select("select * from rentals inner join game on rentals.idgame=game.id where rentals.idmember={$memberid} and rentals.idgame= {$id} and enddate is null");
        if (sizeof($rentedGames) >0) {
            $affected = DB::update("UPDATE rentals SET enddate=NOW() WHERE idgame = ${id} and idmember = ${memberid} and enddate is null");
            return redirect()->route('index');
        } else {
            return redirect()->route('error', ['id' => 6]);
        }
    }
}
