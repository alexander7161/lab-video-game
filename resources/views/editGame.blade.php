@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit ') }}{{$game->name}} <a style="float:right;" href={{ "/game/{$game->id}/delete"}} onclick="return confirm('Are you sure you want to delete this item?');">
                    <button  type="button" class="btn">Delete</button>
                </a> </div>
                <div class="card-body">
    @include('gameForm', ['game' => $game, 'new' => false])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection