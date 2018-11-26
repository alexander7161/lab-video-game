@extends('layouts.app')

@section('content')
@guest
Nothing here...
@else
MemberList 
<br />
{{print_r($users)}}
@endguest
@endsection