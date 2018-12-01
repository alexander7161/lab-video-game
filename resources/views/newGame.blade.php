@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create new game') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('newGame') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"
                                    required autofocus> @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span> @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="releaseyear" class="col-md-4 col-form-label text-md-right">{{ __('Release Year') }}</label>

                            <div class="col-md-6">
                                <input id="releaseyear" type="number" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="releaseyear"
                                    value="{{ old('releaseyear', date('Y')) }}" required> @if($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span> @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="type" value="{{ old('type') }}"
                                    required> @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span> @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea style="min-height: calc(2.19rem + 2px); height: calc(8.19rem + 2px);" id="description" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    name="description" value="{{ old('description') }}" required rows="3"> </textarea>                                @if($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span> @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="platform" class="col-md-4 col-form-label text-md-right">{{ __('Platform') }}</label>

                            <div class="col-md-6">
                                <input id="platform" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="platform" value="{{ old('platform') }}"
                                    required> @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span> @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rating" class="col-md-4 col-form-label text-md-right">{{ __('Rating') }}</label>

                            <div class="col-md-6">
                                <input id="rating" type="number" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="rating" value="{{ old('rating') }}"
                                    required> @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span> @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="imageurl" class="col-md-4 col-form-label text-md-right">{{ __('Image URL') }}</label>

                            <div class="col-md-6">
                                <input id="imageurl" type="url" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="imageurl" value="{{ old('imageurl') }}"
                                    required> @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span> @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
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