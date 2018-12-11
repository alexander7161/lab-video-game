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
        $rentedGames = DB::select("select * from rentals
                                    inner join 
                                    game
                                    on rentals.idgame=game.id
                                    where rentals.iduser={$id} and enddate is null");
        if (sizeof($rentedGames)>=RulesController::getRentGameLimit()) {
            return redirect()->route('error', ['id' => 5]);
        }
        $data = $request->all()['data'];
        if (Auth::user()) {
            Rent::create([
                'idgame' => $data['idgame'],
                'iduser' => $id
            ]);
        }
        return redirect()->back();
    }

    public function deleteRent(Request $request)
    {
        $data = $request->all()['data'];
        $memberid = Auth::id();
        $id = $data['idgame'];
        $rentedGames = DB::select("select * from rentals
                                    inner join
                                    game
                                    on rentals.idgame=game.id
                                    where rentals.iduser={$memberid} and rentals.idgame={$id} and enddate is null");
        if (sizeof($rentedGames) >0) {
            $affected = DB::update("UPDATE rentals SET enddate=NOW() WHERE idgame = ${id} and iduser = ${memberid} and enddate is null");
            return redirect()->back();
        } else {
            return redirect()->route('error', ['id' => 6]);
        }
    }

    public function addExtension($id)
    {
        $extensions = DB::table('rentals')->where('id', $id)->select('extensions')->first();
        if ($extensions->extensions<=RulesController::getExtensionLimit()) {
            DB::table('rentals')->where('id', $id)
            ->increment('extensions');
            return redirect()->back();
        } else {
            return redirect()->route('error', ['id' => 9]);
        }
    }
}
