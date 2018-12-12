<div class="card" style="margin-bottom:8px;">
    <img style="max-height:400px;" class="card-img-top" src="{{asset('img/'.str_replace(' ', '', $game->name).'.jpg')}}" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title" style="display: inline-block;">{{ $game->name }}
    @include('game.stars', ['rating' => $game->rating ]) <a href="{{ $game->recommendedurl}}" class="btn btn-warning btn-sm">View Review</a>
        </h5>
        @volunteer
        <a style="float: right;" href="{{ " /game/{$game->id}/edit"}}" class="btn btn-dark">Edit 
                            </a> @endvolunteer
        <p class="card-text">{{ $game->description }}</p>
        <div class="row">
            <div class="col">
                <dl>
                    <dt>Release Year:</dt>
                    <dd>{{ $game->releaseyear }}</dd>

                    <dt>Type:</dt>
                    <dd>{{ $game->type }}</dd>
                </dl>
            </div>
            <div class="col">
                <dl>
                    <dt>Platform:</dt>
                    <dd>{{ $game->onplatform }}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>