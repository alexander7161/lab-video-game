<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rent;
use Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RentController extends Controller
{
    public function createRent(Request $request)
{
    $id =Auth::id();
    $rentedGames = DB::select("select * from rentals inner join game on rentals.idgame=game.id where rentals.idmember={$id}");
    if(sizeof($rentedGames)>1) {
        return redirect()->route('error', ['id' => 5]);
    }
    $data = $request->all()['data'];
if(Auth::user()) {
    Rent::create([
        'idgame' => $data['idgame'],
        'idmember' => $id
        // 'startdate' => $data['startdate'],
        // 'endate' => $data['enddate']
    ]);
}

    
    return redirect()->route('index');
}

public function deleteRent(Request $request)
{
    $data = $request->all()['data'];
    $memberid = Auth::id();
    $id = $data['idgame'];
    $rentedGames = DB::select("select * from rentals inner join game on rentals.idgame=game.id where rentals.idmember={$memberid} and rentals.idgame= {$id}");
    if(sizeof($rentedGames) >0) {
        $result = DB::delete("DELETE FROM rentals where idgame = ${id} and idmember = ${memberid}");
        return redirect()->route('index');    
    } else {
        return redirect()->route('error', ['id' => 6]);
    }
}
}
