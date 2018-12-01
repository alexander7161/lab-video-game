@extends('layouts.app') 
@section('content') @if ($games)

<style>
    .link-button-container {
        flex: 1;
        margin-right: 4px;
        margin-left: 4px;

    }

    .link-button-button {
        width: 100%;
    }
</style>

<div class="card-columns">
    @foreach ($games as $g)
    <div class="card">
        {{-- <img class="card-img-top" src=".../100px180/" alt="Card image cap"> --}}
        <div class="card-body" style="padding-bottom: 8px;">
            <h5 class="card-title"> {{ $g->name }}</h5>
            {{--
            <p class="card-text">

            </p> --}}


            <div class=" d-flex flex-row justify-content-around" style="padding-top:4px;">

                <a class="link-button-container" href={{ "/game/{$g->id}"}}>
                    <button type="button" class="btn btn-outline-dark link-button-button"  >More Information</button>
            </a> @member @if($g->isavailable)
                <form class="link-button-container" method="POST" action="{{ route('rentgame', ['data' => array('idgame'=>$g->id)] ) }}">
                    @csrf
                    <input type="submit" class="btn btn-outline-dark link-button-button" value="Rent it!" />
                </form>
                @endif @endmember @volunteer
                <a class="link-button-container" class="align-items-stretch" href={{ "/game/{$g->id}/edit"}}>
                <button type="button" class="btn btn-outline-dark link-button-button"  >Edit</button>
            </a> @endvolunteer
            </div>
        </div>
        <a href={{ "/game/{$g->id}"}} style="text-decoration: none; color: @if ($g->isavailable) white @else black @endif;">
            <div class="card-footer @if ($g->isavailable) bg-success text-white @endif">
                <h6>
                    @if ($g->isavailable)
                        Available
                    @else
                        Not available
                    @endif
                </h6>
                                    
            </div>
        </a>
    </div>
    @endforeach
</div>




@else No Games Found. @endif
@endsection