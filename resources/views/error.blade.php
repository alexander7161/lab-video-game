@extends('layouts.app') 
@section('content')
<div class="jumbotron">
    <h1 class="display-4">Oops!</h1>
    <p class="lead">There was a problem.</p>
    <hr class="my-4"> @if(isset($info))
    <p>{{$info}}</p>
    @endif
    <a class="btn btn-primary btn-lg" href="/" role="button">Return Home</a>
</div>
@endsection