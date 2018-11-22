@extends('layouts.app')

@section('content')

@if ($games)
@foreach ($games as $g)
@if ($g->isavailable == 1)
    {{ $g->name }} available
@else
    {{ $g->name }} Not available
@endif

@endforeach
@endif


@endsection