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

{{-- @if($game->rating)
<script>
    document.getElementById("stars").innerHTML = getStars({{ $game->rating}});

    function getStars(rating) {

        // Round to nearest half
        rating = Math.round(rating * 2) / 2;
        let output = [];

        // Append all the filled whole stars
        for (var i = rating; i >= 1; i--)
        output.push('<i class="fa fa-star" aria-hidden="true" style="color: gold;"></i>&nbsp;');

        // If there is a half a star, append it
         if (i == .10) output.push('<i class="fa fa-star-half-o" aria-hidden="true" style="color: gold;"></i>&nbsp;');

        // Fill the empty stars
        for (let i = (10 - rating); i >= 1; i--)
        output.push('<i class="fa fa-star-o" aria-hidden="true" style="color: gold;"></i>&nbsp;');

        return output.join('');
    }

</script>
@endif --}}