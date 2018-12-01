@extends('layouts.app') 
@section('content')
<?php
$isavailable = sizeof($data['rents']) == 0;
?>
    <div class="container">
        <!-- Left Column / Game Image -->
        <div class="col-lg-7">
            <img class="img-thumbnail" src="../artworks/{$game->id}.jpg">
        </div>
        <!-- Right Column -->
        <div class="col-lg-5">
            @volunteer
            <a href={{ "/game/{$data['game']->id}/edit"}}>
               <button  type="button" class="btn">Edit</button>
          </a> @endvolunteer
            <!-- Game descritions -->
            <dl class="row">
                <dt class="col-sm-3">Name Of Game:</dt>
                <dd class="col-sm-9">{{ $data['game']->name }}</dd>

                <dt class="col-sm-3">Availability</dt> @if ($isavailable)
                <dd class="col-sm-9">available</dd>
                @else
                <dd class="col-sm-9">unavailable</dd>
                @endif

                <dt class="col-sm-3">Currently being rented:</dt>
                <dd class="col-sm-9">{{sizeof($data['rents'])}}</dd>

                @if($data['rents']) @useridequals($data['rents'][0]->idmember==Auth::id())
                <dt class="col-sm-3">Rented by:</dt>
                <dd class="col-sm-9">You</dd>
                @else @volunteer
                <dt class="col-sm-3">Rented by:</dt>
                <dd class="col-sm-9">
                    <a href="/account/{{$data['rents'][0]->idmember}}">
                 {{$data['rents'][0]->username}}
                 </a>
                </dd>
                @endvolunteer @enduseridequals @endif @if($data['game']->releaseyear)

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
            @member @if($isavailable)
            <form method="POST" action="{{ route('rentgame', ['data' => array('idgame'=>$data['game']->id)] ) }}">
                @csrf
                <input class="btn btn-outline-success" {{(!$isavailable? "disabled": "")}} type='submit' value="Rent it!" />
            </form>
            @else @useridequals($data['rents'][0]->idmember)
            <form onSubmit="return confirm('Are you sure you want to return this item?');" method="POST" action="{{ route('unrentgame', ['data' => array('idgame'=>$data['game']->id)] ) }}">
                @csrf
                <input class="btn btn-outline-danger" type='submit' value="Send Back!" />
            </form>
            @enduseridequals @endif @endmember


        </div>
        <!-- Scripts -->
        @if($data['game']->rating)
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