@extends('layouts.app')
<?php 
$u = $user;
?> 
@section('content') {{print_r($user)}}
<br/>
<br/>
<br/> {{print_r($games)}}
<br/>
<br/> @if(sizeof($violations)>0) @foreach($violations as $v) {{print_r($v)}}
<form action="/account/removeviolation/{{$v->id}}" method="GET">
    <button type="submit" class="btn {{$u->banned? " btn-outline-danger ":"btn-outline-dark "}}">Remove Violation</button></form>
@endforeach {{print_r($violations)}} @else No Violations @endif @volunteer
<form action="/account/{{$u->id}}/addviolation" method="GET">
    <button type="submit" class="btn {{$u->banned? " btn-outline-danger ":"btn-outline-dark "}}">Add Violation</button></form>
@if(!$u->volunteer)
<form action="/account/{{$u->id}}/{{$u->banned?'unban':'ban'}}" method="GET">
    <button type="submit" class="btn {{$u->banned? " btn-outline-danger ":"btn-outline-dark "}}">{{$u->banned?"Unban" : "Ban" }}</button></form>@endif
@endvolunteer
@endsection