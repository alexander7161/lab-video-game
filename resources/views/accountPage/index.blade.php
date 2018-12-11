@extends('layouts.app') 
@section('content')
<div class="row">
    <div class="col-sm">
    @include('accountPage.leftpanel', ['user' => $user, 'games' => $games,'violations' =>$violations])
    </div>
    <div class="col-sm">
    @include('accountPage.rightpanel', ['user' => $user, 'games' => $games,'violations'=>$violations])
    </div>
</div>
@endsection