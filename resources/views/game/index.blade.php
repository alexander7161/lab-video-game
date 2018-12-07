@extends('layouts.app') 
@section('content')
<?php
$isavailable = sizeof($renting) == 0;
?>
    <div class="row">
        <div class="col-sm">
    @include('game.leftpanel', ['game' => $game, 'isavailable' => $isavailable, ])
        </div>
        <div class="col-sm">
    @include('game.rightpanel', ['renting' => $renting, 'isavailable' => $isavailable,'rentalhistory'=>$rentalhistory, 'renting'=>$renting])
        </div>
    </div>

    <!-- Scripts -->
    @if($game->rating)
    <script>
        document.getElementById("stars").innerHTML = getStars({{ $game->rating}});

        function getStars(rating) {

            // Round to nearest half
            rating = Math.round(rating * 2) / 2;
            let output = [];

            // Append all the filled whole stars
            for (var i = rating; i >= 1; i--)
            output.push('<i class="fa fa-star" aria-hidden="true" style="color: gold;"></i>&nbsp;');

            // If there is a half a star, append it
             if (i == .10) output.push('<i class="fa fa-star-half-o" aria-hidden="true" style="color: gold;"></i>&nbsp;');

            // Fill the empty stars
            for (let i = (10 - rating); i >= 1; i--)
            output.push('<i class="fa fa-star-o" aria-hidden="true" style="color: gold;"></i>&nbsp;');

            return output.join('');
        }
    </script>
    @endif
@endsection