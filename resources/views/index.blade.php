@extends('layouts.app')

@section('content')
{{-- {{print_r($games)}} --}}

@foreach ($games as $g)
@if ($g->isavailable == 1)
    {{ $g->name }} available
@else
    {{ $g->name }} Not available
@endif

@endforeach

@endsection