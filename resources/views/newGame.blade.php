@extends('layouts.app')

@section('content')

{{ Auth::user()->volunteer }}
{{ Form::open(array('url' => 'foo/bar')) }}

{{ Form::close() }}

@endsection