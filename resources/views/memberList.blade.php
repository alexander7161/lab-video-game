@extends('layouts.app') 
@section('content')
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Volunteer</th>
                @secretary
                <th scope="col">Secretary</th>@endsecretary
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $u)
            <tr class={{ $u->volunteer ? $u->secretary? "table-warning": "table-success" : ""}}>
                <th scope="row"><a class="btn btn-outline-dark" role="button" href="/account/{{$u->id}}">{{$u->id}}</a></th>
                <td><a style="color:black;" href="/account/{{$u->id}}">{{$u->name}} </a> @if($u->volunteer)<span class="badge badge-success">Volunteer</span>@endif
                    @if($u->secretary)
                    <span class="badge badge-warning">Secretary</span>@endif</td>
                <td>{{$u->email}}</td>
                <td>
                    @if(!$u->secretary)
                    <form method="POST" action="{{ route('members', ['data' => array('id'=>$u->id, 'volunteer'=>$u->volunteer)] ) }}">
                        @csrf
                        <input class="btn {{$u->volunteer? " btn-dark " : "btn-outline-dark "}} " type='submit' value="{{$u->volunteer? " Remove
                            Volunteer " : "Make Volunteer "}}" />
                    </form>
                    @endif
                </td>
                @secretary
                <td>
                    @if(!$u->secretary)
                    <form method="POST" action="{{ route('makeSecretary', ['data' => array('id'=>$u->id)] ) }}" onSubmit="return confirm('Are you sure you want to give up the secretary role?');">
                        @csrf
                        <input class="btn btn-outline-dark" type='submit' value="Make Secretary" />
                    </form>
                    @endif
                </td>
                @endsecretary
            </tr>
            @endforeach


        </tbody>
    </table>
</div>
@endsection