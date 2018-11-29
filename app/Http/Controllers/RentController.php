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
    $data = $request->all()['data'];
if(Auth::user()) {
    Rent::create([
        'idgame' => $data['idgame'],
        'idmember' => Auth::id()
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
    DB::delete("DELETE FROM rentals where idgame = ${id} and idmember = ${memberid}");
    return redirect()->route('index');
}
}
