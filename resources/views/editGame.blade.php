@extends('layouts.app')

@section('content')
<a href={{"/game/{$game->id}/delete"}} onclick="return confirm('Are you sure you want to delete this item?');">
    <button  type="button" class="btn">Delete</button>
</a>
{{ Form::open(array('url' => 'foo/bar')) }}

{{ Form::close() }}
editGame {{$game->id}}

@endsection