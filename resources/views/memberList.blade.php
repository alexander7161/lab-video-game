@extends('layouts.app') 
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Currently Renting</th>
                            @secretary
                            <th scope="col">Volunteer</th>
                            <th scope="col">Secretary</th>@endsecretary
                            <th scope="col">Banned</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $u)
                        <tr class="{{$u->banned?'table-danger':''}} {{$u->volunteer ? $u->secretary? 'table-warning': 'table-success' : ''}}">
                            <th scope="row"><a class="btn btn-outline-dark" role="button" href="/account/{{$u->id}}">ID: {{$u->id}}</a></th>
                            <td><a style="color:black;" href="/account/{{$u->id}}">{{$u->name}} </a> @if($u->volunteer)
                                <span class="badge badge-success">Volunteer</span>@endif @if($u->secretary)
                                <span class="badge badge-warning">Secretary</span>@endif</td>
                            <td>{{$u->email}}</td>
                            <td>{{$u->currentrentals}}</td>
                            @secretary
                            <td>
                                @if(!$u->secretary)
                                <form method="POST" action="{{ route('members', ['data' => array('id'=>$u->id, 'volunteer'=>$u->volunteer)] ) }}">
                                    @csrf
                                    <input class="btn {{$u->volunteer? " btn-dark " : "btn-outline-dark "}} " type='submit' value="{{$u->volunteer? " Remove
                                        Volunteer " : "Make Volunteer "}}" />
                                </form>
                                @endif
                            </td>
                            <td>
                                @if(!$u->secretary)
                                <form method="POST" action="{{ route('makeSecretary', ['data' => array('id'=>$u->id)] ) }}" onSubmit="return confirm('Are you sure you want to give up the secretary role?');">
                                    @csrf
                                    <input class="btn btn-outline-dark" type='submit' value="Make Secretary" />
                                </form>
                                @endif
                            </td>
                            @endsecretary
                            <td>@if(!$u->volunteer)
                                <form action="/account/{{$u->id}}/{{$u->banned?'unban':'ban'}}" method="GET">
                                    <button type="submit" class="btn {{$u->banned? " btn-outline-danger ":"btn-outline-dark "}}">{{$u->banned?"Unban" : "Ban" }}</button></form>@endif</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection