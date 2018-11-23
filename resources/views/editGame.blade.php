@extends('layouts.app')

@section('content')
@guest
Nothing here...
@else
{{ Auth::user()->volunteer }}
{{ Form::open(array('url' => 'foo/bar')) }}

{{ Form::close() }}
editGame {{$id}}

@endguest
@endsection