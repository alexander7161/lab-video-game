@extends('layouts.app') 
@section('content')
<?php
$isavailable = sizeof($renting) == 0;
?>
    <div class="row">
        <div class="col-sm">
    @include('game.leftpanel', ['game' => $game, 'isavailable' => $isavailable, ])
        </div>
        @member
        <div class="col-sm">
    @include('game.rightpanel', ['renting' => $renting, 'isavailable' => $isavailable,'rentalhistory'=>$rentalhistory, 'renting'=>$renting])
        </div>@endmember
    </div>
@endsection