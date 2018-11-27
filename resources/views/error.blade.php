@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <h1 class="display-4">Oops!</h1>
        <p class="lead">You're not allowed to do that.</p>
        <hr class="my-4">
        @if(isset($info))
    <p>{{$info}}</p>
        @endif
        <a class="btn btn-primary btn-lg" href="/" role="button">Return Home</a>
    </div>
@endsection