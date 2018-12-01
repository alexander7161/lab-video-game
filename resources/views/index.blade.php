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
    <?php
    $buttonStyle =  $g->isavailable? "btn-outline-light" : "btn-outline-dark";
    ?>
        <div class="card">
            {{-- <img class="card-img-top" src=".../100px180/" alt="Card image cap"> --}}
            <div class="card-body" style="padding-bottom: 8px;">
                <h5 class="card-title"> {{ $g->name }}</h5>
                <div style="position: absolute; top: 4px; right: 4px;">
                    @if ($g->isavailable)
                    <span class="badge badge-success">Available</span> @else
                    <span class="badge badge-secondary">Not Available</span> @endif
                </div>
                {{--
                <p class="card-text">

                </p> --}}

            </div>
            <div class="card-footer @if ($g->isavailable) bg-success text-white @endif" style="padding-right: 8px; padding-left: 8px;">
                {{--
                <h6>
                    @if ($g->isavailable) Available @else Not available @endif
                </h6> --}}
                <div class=" d-flex flex-row justify-content-around">

                    <a class="link-button-container" href={{ "/game/{$g->id}"}}>
                            <button type="button" class="btn {{$buttonStyle }} link-button-button"  >More Information</button>
                    </a> @member @if($g->isavailable)
                    <form class="link-button-container" method="POST" action="{{ route('rentgame', ['data' => array('idgame'=>$g->id)] ) }}">
                        @csrf
                        <input type="submit" class="btn {{$buttonStyle }} link-button-button" value="Rent it!" />
                    </form>
                    @endif @endmember @volunteer
                    <a class="link-button-container" class="align-items-stretch" href={{ "/game/{$g->id}/edit"}}>
                        <button type="button" class="btn {{$buttonStyle }} link-button-button"  >Edit</button>
                    </a> @endvolunteer
                </div>

            </div>
        </div>
        @endforeach
</div>




@else No Games Found. @endif
@endsection