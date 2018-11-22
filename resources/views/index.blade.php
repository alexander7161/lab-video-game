@extends('layouts.app')

@section('content')

@if ($games)
    @foreach ($games as $g)
        <a href={{"/game/{$g->idgame}"}}>
            @if ($g->isavailable == 1)
                {{ $g->name }} available
            @else
                {{ $g->name }} Not available
            @endif
        </a>
    @endforeach
@endif


@endsection