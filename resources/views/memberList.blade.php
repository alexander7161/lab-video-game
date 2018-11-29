@extends('layouts.app')

@section('content')
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
                <tr >
                <th scope="row"><a class="btn btn-info" role="button" href="/account/{{$u->id}}">{{$u->id}}</a></th>
                    <td>{{$u->name}}</td>
                    <td>{{$u->email}}</td>
                    <td 
                    class={{$u->volunteer? "table-success" : ""}}>
                    {{-- <a class="btn btn-info" role="button" onClick={{action('UserController@toggleVolunteer',$u->$u)}}>{{$u->id}}</a> --}}
                        {{$u->volunteer? "T" : "F"}}
                    </td>
                </tr>
            @endforeach
          
       
        </tbody>
      </table>

@endsection