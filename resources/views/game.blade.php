@extends('layouts.app') 
@section('content')
<?php
$isavailable = sizeof($data['rents']) == 0;
?>
    <div class="container">
        <!-- Left Column / Game Image -->
        <div class="col-lg-7">
            <img class="img-thumbnail" src="../../public/img/{$game->id}.jpg">
        </div>
        <!-- Right Column -->
        <div class="col-lg-5">
            @if(Auth::user() && Auth::user()->volunteer)
            <a href={{ "/game/{$data['game']->id}/edit"}}>
               <button  type="button" class="btn">Edit</button>
          </a> @endif
            <!-- Game descritions -->
            <dl class="row">
                <dt class="col-sm-3">Name Of Game:</dt>
                <dd class="col-sm-9">{{ $data['game']->name }}</dd>

                <dt class="col-sm-3">Availability</dt> 
                @if ($isavailable)
                <dd class="col-sm-9">available</dd>
                @else
                <dd class="col-sm-9">unavailable</dd>
                @endif

                <dt class="col-sm-3">Currently being rented:</dt>
                <dd class="col-sm-9">{{sizeof($data['rents'])}}</dd>

                @if(Auth::user() && $data['rents'] && $data['rents'][0]->idmember==Auth::id())
                <dt class="col-sm-3">Rented by:</dt>
                <dd class="col-sm-9">You</dd>
                @elseif($data['rents'] && Auth::user() && Auth::user()->volunteer)
                <dt class="col-sm-3">Rented by:</dt>
                <dd class="col-sm-9">
                    <a href="/account/{{$data['rents'][0]->idmember}}">
                 {{$data['rents'][0]->username}}
                 </a>
                </dd>
                @endif @if($data['game']->releaseyear)

                <dt class="col-sm-3">Release Year:</dt>
                <dd class="col-sm-9">{{ $data['game']->releaseyear }}</dd>

                <dt class="col-sm-3">Type:</dt>
                <dd class="col-sm-9">{{ $data['game']->type }}</dd>

                <dt class="col-sm-3">Platform:</dt>
                <dd class="col-sm-9">{{ $data['game']->platform }}</dd>

                <dt class="col-sm-3">Description:</dt>
                <dd class="col-sm-9">{{ $data['game']->description }}</dd>

                <dt class="col-sm-3">Rating:</dt>
                <dd class="col-sm-9"><span id=stars></span><a>Reputable Medias</a></dd> @endif
            </dl>
            @guest @else @if($isavailable)
            <form method="POST" action="{{ route('rentgame', ['data' => array('idgame'=>$data['game']->id)] ) }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input class="btn btn-info" {{(!$isavailable? "disabled": "")}} type='submit' value="Rent it!" />
            </form>
            @elseif($data['rents'][0]->idmember==Auth::id())
            <form method="POST" action="{{ route('unrentgame', ['data' => array('idgame'=>$data['game']->id)] ) }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input class="btn btn-info" type='submit' value="Send Back!" />
            </form>
            @endif @endguest


        </div>
        <!-- Scripts -->
        @if($data['game']->rating) {{-- TODO add to database --}}
        <script>
            document.getElementById("stars").innerHTML = getStars({{ $data['game']->rating}});

        function getStars(rating) {

            // Round to nearest half
            rating = Math.round(rating * 2) / 2;
            let output = [];

            // Append all the filled whole stars
            for (var i = rating; i >= 1; i--)
            output.push('<i class="fa fa-star" aria-hidden="true" style="color: gold;"></i>&nbsp;');

            // If there is a half a star, append it
             if (i == .5) output.push('<i class="fa fa-star-half-o" aria-hidden="true" style="color: gold;"></i>&nbsp;');

            // Fill the empty stars
            for (let i = (5 - rating); i >= 1; i--)
            output.push('<i class="fa fa-star-o" aria-hidden="true" style="color: gold;"></i>&nbsp;');

            return output.join('');
        }
        </script>
        @endif
@endsection