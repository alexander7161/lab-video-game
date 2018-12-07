<div class="card">
    <img style="max-height:400px;" class="card-img-top" src="{{asset('img/'.str_replace(' ', '', $game->name).'.jpg')}}" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title" style="display: inline-block;">{{ $game->name }} <span id=stars></span></h5>
        @volunteer
        <a style="float: right;" href="{{ " /game/{$game->id}/edit"}}" class="btn btn-dark">Edit 
                            </a> @endvolunteer
        <p class="card-text">{{ $game->description }}</p>
        <dl>
            <dt>Availability</dt> @if ($isavailable)
            <dd>available</dd>
            @else
            <dd>unavailable</dd>
            @endif {{-- <dt class="col-sm-5">Currently being rented:</dt>
            <dd class="col-sm-9">{{sizeof($renting)}}</dd> --}} @if($game->releaseyear)

            <dt>Release Year:</dt>
            <dd>{{ $game->releaseyear }}</dd>

            <dt>Type:</dt>
            <dd>{{ $game->type }}</dd>

            <dt>Platform:</dt>
            <dd>{{ $game->onplatform }}</dd>
            @endif
        </dl>
    </div>
</div>