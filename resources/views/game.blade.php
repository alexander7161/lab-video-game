@extends('layouts.app')

@section('content')
     @if(Auth::user() && Auth::user()->volunteer)
          <a href={{"/game/{$game->id}/edit"}}>
               <button  type="button" class="btn">Edit</button>
          </a>
     @endif
     {{ $game->name }}
     @if ($game->isavailable == 1)
          available
     @else
          Not available
     @endif
@endsection