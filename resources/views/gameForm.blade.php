<form method="POST" action="{{ $new? route('newGame'): route('editGame', $game->id) }}">
    @csrf @if(isset($game))
    <input type="hidden" id="id" name="id" value="{{$game->id}}">@endif

    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', isset($game)? $game->name : '') }}"
                required autofocus> @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span> @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="releaseyear" class="col-md-4 col-form-label text-md-right">{{ __('Release Year') }}</label>

        <div class="col-md-6">
            <input id="releaseyear" type="number" class="form-control{{ $errors->has('releaseyear') ? ' is-invalid' : '' }}" name="releaseyear"
                value="{{ old('releaseyear', isset($game)? $game->releaseyear : date('Y')) }}" required> @if($errors->has('releaseyear'))
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('releaseyear') }}</strong>
                                    </span> @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>

        <div class="col-md-6">
            <input id="type" type="text" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" value="{{ old('type', isset($game)? $game->type : '') }}"
                required> @if ($errors->has('type'))
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span> @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

        <div class="col-md-6">
            <textarea style="min-height: calc(2.19rem + 2px); height: calc(8.19rem + 2px);" id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                name="description" required rows="3">{{old('description', isset($game)? $game->description : '')}}</textarea>            @if($errors->has('description'))
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span> @endif
        </div>
    </div>
    <div class="form-group row">
        <label for="platform" class="col-md-4 col-form-label text-md-right">{{ __('Platform') }}</label>

        <div class="col-md-6">
            <select id="platform" class="form-control" name="platform">
                    @if(isset($platforms))@foreach($platforms as $p)
                        <option  value ="{{$p->unnest}}" @if(isset($game) && $game->onplatform==$p->unnest) selected @endif>{{$p->unnest}}</option>
                        @endforeach @endif
                    </select> {{-- <input id="platform" type="text" class="form-control{{ $errors->has('platform') ? ' is-invalid' : '' }}"
                name="platform" value="{{ old('platform', isset($game)? $game->onplatform : '') }}" required> @if ($errors->has('platform'))
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('platform') }}</strong>
                                    </span> @endif --}}
        </div>
    </div>
    <div class="form-group row">
        <label for="rating" class="col-md-4 col-form-label text-md-right">{{ __('Rating') }}</label>

        <div class="col-md-6">
            <input id="rating" type="number" class="form-control{{ $errors->has('rating') ? ' is-invalid' : '' }}" name="rating" value="{{ old('rating', isset($game)? $game->rating : '') }}"
                required> @if ($errors->has('rating'))
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rating') }}</strong>
                                    </span> @endif
        </div>
    </div>
    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                                    {{ $new? __('Create') : __('Submit') }}
                                </button>
        </div>
    </div>
</form>