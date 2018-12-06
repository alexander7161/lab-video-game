@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create new game') }}</div>
                <div class="card-body">
    @include('gameForm', ['new' => true])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection