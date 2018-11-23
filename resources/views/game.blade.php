@extends('layouts.app')
@section('content')

@guest
@else
@if(Auth::user()->volunteer)
<a href={{"/game/{$game[0]->id}/edit"}}>
                                        <button  type="button" class="btn">Edit</button>
</a>
@endif
@endguest

@if(sizeof($game) > 0)
{{ $game[0]->name }}
@if ($game[0]->isavailable == 1)
                 available
            @else
                 Not available
            @endif
@else
No game found
@endif
@endsection