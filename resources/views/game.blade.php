@extends('layouts.app')

@section('content')
<div class="container">
     <!-- Left Column / Game Image -->
     <div class="col-lg-7">
        <img class="img-thumbnail" src="../artworks/{$game->id}.jpg">
     </div>
     <!-- Right Column -->
     <div class="col-lg-5">
     @if(Auth::user() && Auth::user()->volunteer)
          <a href={{"/game/{$data['game']->id}/edit"}}>
               <button  type="button" class="btn">Edit</button>
          </a>
     @endif
        <!-- Game descritions -->
        <dl class="row">
            <dt class="col-sm-3">Name Of Game:</dt>
            <dd class="col-sm-9">{{ $data['game']->name }}</dd>

            <dt class="col-sm-3">Availability</dt>
            @if ($data['game']->isavailable == 1)
                <dd class="col-sm-9">available</dd>
            @else
                <dd class="col-sm-9">unavailable</dd>
            @endif

            <dt class="col-sm-3">Currently being rented:</dt>
            <dd class="col-sm-9">{{sizeof($data['rents'])}}</dd>

            @if(isset($data['game']->type))

            <dt class="col-sm-3">Release Year:</dt>
            <dd class="col-sm-9">{{ $$data['game']->releaseYear }}</dd>

            <dt class="col-sm-3">Type:</dt>
            <dd class="col-sm-9">{{ $data['game']->type }}</dd>

            <dt class="col-sm-3">Platform:</dt>
            <dd class="col-sm-9">{{ $data['game']->platform }}</dd>

            <dt class="col-sm-3">Description:</dt>
            <dd class="col-sm-9">{{ $data['game']->description }}</dd>

            <dt class="col-sm-3">Rating:</dt>
            <dd class="col-sm-9"><span id=stars></span><a href="/game/{{$data['game']->ratingURL}}">Reputable Medias</a></dd>
        @endif
          </dl>
        @if ($data['game']->isavailable == 1)
            <button type="button" class="btn btn-info">Book it!</button>
        @else
            <button type="button" class="btn btn-info" disabled>Book it!</button>
        @endif

     </div>
     <!-- Scripts -->
     @if(isset($data['game']->type))
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
             if (i == .5) output.push('<i class="fa fa-star-half-o" aria-hidden="true" style="color: gold;"></i>&nbsp;');

            // Fill the empty stars
            for (let i = (5 - rating); i >= 1; i--)
            output.push('<i class="fa fa-star-o" aria-hidden="true" style="color: gold;"></i>&nbsp;');

            return output.join('');
        }
     </script>  
     @endif
@endsection