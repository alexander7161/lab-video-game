@extends('layouts.app') 
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit rules') }}</div>
                <div class="card-body">
                

<form method="POST" action="{{ route('editRules') }}">
    @csrf 
    
  

    @foreach ($rules as $k=>$v) 

    <div class="form-group row">
        <label for="{{$k}}" class="col-md-4 col-form-label text-md-right">{{ __("rules." . $k) }}</label>

        <div class="col-md-6">
                <div class="form-group">
            @if($k=='rentalperiod' || $k=='rulevioperiod' || $k=='banperiod')
            <?php
            $pieces = explode(" ", $v);
            $val = $pieces[0];
            $type = $pieces[1];
            ?>
                    <input id="{{$k}}" type="number" class="form-control{{ $errors->has($k) ? ' is-invalid' : '' }}" name="{{$k}}" value="{{ old($k, $val) }}"
                    required autofocus>
                <select id="{{$k}}time" class="form-control" value="{{$type}}" name="{{$k}}time">
                      <option  value ="days" @if($type=="days") selected @endif>days</option>
                      <option  value ="weeks" @if($type=="weeks") selected @endif>weeks</option>
                      <option  value ="months" @if($type=="mons") selected @endif>months</option>
                      <option value ="years" @if($type=="year") selected @endif>years</option>
                    </select>

            @else
        <input id="{{$k}}" type="text" class="form-control{{ $errors->has($k) ? ' is-invalid' : '' }}" name="{{$k}}" value="{{ old($k, $v) }}"
                required autofocus> @if ($errors->has($k))
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first($k) }}</strong>
                                    </span> @endif
@endif
</div>
        </div>
    </div>

    @endforeach
    
    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                                    {{  __('Submit') }}
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