@extends('layouts.app') 
@section('content')
<a href="/newrental" class="btn btn-dark" style="margin:4px;">New Rental</a>
<div class="row justify-content-center">

    <div class="col-md-12">

        <div class="card">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Rent ID</th>
                            <th scope="col">Game</th>
                            <th scope="col">User</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Due Date</th>
                            <th scope="col">Extensions</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rentals as $r)
                        <tr class="{{$r->duedate?'table-success':''}}">
                            <th scope="row">{{$r->rentalid}}</th>
                            <td><a style="color:black;" href="/game/{{$r->gameid}}">{{$r->gamename}} </a> </td>
                            <td><a style="color:black;" href="/account/{{$r->userid}}">{{$r->username}} </a> </td>
                            <td>
                                <?php
                                $timestamp = strtotime($r->startdate);
                                echo date("d/m/Y", $timestamp) ." at ".date("H:i", $timestamp);
                            ?>
                            </td>
                            <td>
                                @if($r->enddate)
                                <?php
                                $timestamp = strtotime($r->enddate);
                                echo date("d/m/Y", $timestamp) ." at ".date("H:i", $timestamp);
                            ?>
                                    @else - @endif
                            </td>
                            <td>
                                @if($r->duedate)
                                <?php
                                    $timestamp = strtotime($r->duedate);
                                    echo date("d/m/Y", $timestamp) ." at ".date("H:i", $timestamp);
                                ?>
                                    @else - @endif
                            </td>
                            <td>
                                {{$r->extensions}}
                            </td>
                            <td>
                                @if($r->duedate)
                                <form method="POST" action="{{ route('endrental', ['id'=>$r->rentalid] ) }}" onSubmit="return confirm('Are you sure you want to end the rental of {{$r->gamename}} to {{$r->username}}?');">
                                    @csrf
                                    <input class="btn btn-outline-dark" type='submit' value="End Rent" />
                                </form>
                                @endif
                            </td>
                            <td>
                                <form method="POST" action="{{ route('damaged', ['id=>$r->idgame'])}}">
                                    @csrf
                                    <input class="btn btn-outline-danger" type='submit' value="Report Broken" />
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection