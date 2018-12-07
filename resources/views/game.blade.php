@extends('layouts.app') 
@section('content')
<?php
$isavailable = sizeof($renting) == 0;
?>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <img style="max-height:400px;" class="card-img-top" src="{{asset('img/'.str_replace(' ', '', $game->name).'.jpg')}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{ $game->name }} <span id=stars></span></h5>
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
                    @volunteer
                    <div style="display:inline-block;">
                        <a href="{{ " /game/{$game->id}/edit"}}" class="btn btn-dark">Edit 
                                    </a> @endvolunteer
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">

                    @if($renting) @useridequals($renting[0]->idmember==Auth::id())
                    <dt>Rented by:</dt>
                    <dd> <a style="color:black;" href="/account">
                                    You</a></dd>
                    @else
                    <dt>Rented by:</dt>
                    <dd>

                        @volunteer <a style="color:black;" href="/account/{{$renting[0]->idmember}}">@endvolunteer
                                 {{$renting[0]->username}}
                                 @volunteer </a>@endvolunteer
                    </dd>
                    @enduseridequals @endif @member @if($isavailable)
                    <form style="display: inline-block;" method="POST" action="{{ route('rentgame', ['data' => array('idgame'=>$game->id)] ) }}">
                        @csrf
                        <input class="btn btn-outline-success" {{(!$isavailable? "disabled": "")}} type='submit' value="Rent it!" />
                    </form>
                    @else @useridequals($renting[0]->idmember)
                    <form style="display: inline-block;" onSubmit="return confirm('Are you sure you want to return this item?');" method="POST"
                        action="{{ route('unrentgame', ['data' => array('idgame'=>$game->id)] ) }}">
                        @csrf
                        <input class="btn btn-outline-danger" type='submit' value="Send Back!" />
                    </form>
                    @enduseridequals @endif @endmember
                </div>
            </div>

            <div class="card" style="margin-top:8px;">
                <div class="card-body">
                    <h5 class="card-title">Rental History</h5>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">End Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rentalhistory as $r)
                            <tr>
                                <td> {{$r->username}}</td>
                                <td>
                                    <?php 
                                            $timestamp = strtotime($r->startdate);
                                                echo date("Y/m/d - H:i", $timestamp); ?> </td>
                                <td>
                                    <?php 
                                            if($r->enddate)  {
                                                $timestamp = strtotime($r->enddate);
                                            echo date("d-m-Y", $timestamp);
                                            }  else {
                                                echo "Currently Renting";
                                            }
                                         ?> </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        @if($game->rating)
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
        @endif
@endsection