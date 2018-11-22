@extends('layouts.app')

@section('content')

@if ($games)
    @foreach ($games as $g)
        <a href={{"/game/{$g->id}"}}>
            {{ $g->name }}
            @if ($g->isavailable == 1)
                 available
            @else
                 Not available
            @endif
        </a>
    @endforeach
@endif


@endsection