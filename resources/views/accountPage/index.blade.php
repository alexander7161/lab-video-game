@extends('layouts.app') 
@section('content')
<div class="row">
    <div class="col-sm">
    @include('accountPage.leftPanel', ['user' => $user, 'games' => $games,'violations' =>$violations, 'ban' => $ban])
    </div>
    <div class="col-sm">
    @include('accountPage.rightPanel', ['user' => $user, 'games' => $games,'violations'=>$violations])
    </div>
</div>
@endsection