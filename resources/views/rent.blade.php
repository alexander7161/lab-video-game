@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('New Rental') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('createnewrental') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="user" class="col-md-4 col-form-label text-md-right">{{ __('User') }}</label>

                            <div class="col-md-6">
                                <select id="user" class="form-control" name="user">
                                        @if(isset($users))@foreach($users as $u)
                                            <option  value ="{{$u->id}}">{{"ID:".$u->id. " - ".$u->name}}</option>
                                            @endforeach @endif
                                        </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="game" class="col-md-4 col-form-label text-md-right">{{ __('Game') }}</label>

                            <div class="col-md-6">
                                <select id="game" class="form-control" name="game">
                                        @if(isset($games))@foreach($games as $g)
                                            <option  value ="{{$g->id}}">{{"ID:".$g->id. " - ".$g->name}}</option>
                                            @endforeach @endif
                                        </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection