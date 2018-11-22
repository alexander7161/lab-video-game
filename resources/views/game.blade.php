@extends('layouts.app')
@section('content')
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