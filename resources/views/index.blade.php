@extends('layouts.app') 
@section('content') @if ($games)
<div class="card-columns">
    @foreach ($games as $g)
    <div class="card">
        {{-- <img class="card-img-top" src=".../100px180/" alt="Card image cap"> --}}
        <div class="card-body">
            <h5 class="card-title"> {{ $g->name }}</h5>

            {{--
            <p class="card-text">

            </p> --}}

        </div>
        @volunteer
        <a href={{ "/game/{$g->id}/edit"}}>
                                        <button  type="button" class="btn">Edit</button>
</a> @endvolunteer
        <a href={{ "/game/{$g->id}"}} style="text-decoration:  none; color: black;">

                            @if ($g->isavailable == 1)
                                <div class="card-footer bg-success text-white">
                                    <h6>
                                        available
                                        {{-- <button type="button" class="btn btn-outline-light">More Info</button> --}}

                                    </h6>
                                </div>
                            @else
                                <div class="card-footer">
                                    <h6>
                                        Not available
                                    </h6>
                                </div>
                            @endif
                        </a>


    </div>
    @endforeach
</div>





@endif
@endsection