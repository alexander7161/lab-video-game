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
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $u)
            <tr>
                <th scope="row"><a class="btn btn-outline-dark" role="button" href="/account/{{$u->id}}">{{$u->id}}</a></th>
                <td><a style="color:black;" href="/account/{{$u->id}}">{{$u->name}}</a></td>
                <td>{{$u->email}}</td>
                <td class={{$u->volunteer? "table-success" : ""}}>
                    <form method="POST" action="{{ route('members', ['data' => array(" id "=>$u->id, "volunteer "=>$u->volunteer)] ) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input class="btn {{$u->volunteer? " btn-dark " : "btn-outline-dark "}} " type='submit' value="{{$u->volunteer? " Remove
                            Volunteer " : "Make Volunteer "}}" />
                    </form>
                </td>
            </tr>
            @endforeach


        </tbody>
    </table>
</div>
@endsection