@extends('layouts.app')


{{-- @section('script')
    <script type="text/javascript">
        ReactDOM.render(<Example/>, document.getElementById('example'));
    </script>
@endsection --}}

@section('content')


    {{-- <div id="example"></div> --}}
    <div class="container search-table">
<div class="search-box">
<div class="row">
<div class="col-md-3">
<h5>Search All Games</h5>
</div>
<div class="col-md-9">
<form name="form" action="" method="get">
<input type="text" name="myInput" id="myInput" onkeyup="myFunction()" class="form-control" placeholder="Search all Video Games .. ">
</form>
<h1 id="demo"></h1>

<script>
function myFunction() {
    var input = document.getElementById("myInput").value;
    document.getElementById("demo").innerHTML = input;
}
</script>


<!--<script>
(document).ready(function () {
("#myInput").on("keyup", function () {
var value = $(this).val().toLowerCase();
var newGames= ("$games").filter(function () {
(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
});
});
});
</script>-->

    @if ($games)
    <table class="table" id="myTable">
                                <thead>
                                <tr>
                                <th>Title</th>
                                <th>Availability</th>
                                </tr>
                                </thead>
            @foreach ($games as $g)
            @if (1)
               <tbody>

                                <tr>
                                <td>{{ $g->gamename }}</td>
                                @if ($g->isavailable == 1)
                                <td >
                                <a href={{"/game/{$g->id}"}} >Available</a>
                                </td>
                                @else
                                    <td>
                                    <a href={{"/game/{$g->id}"}} >Not Available</a>
                                    </td>
                                @endif
                                
                                </tr>
                                </tbody>
                  
                                
                            </p> 
                
                        @guest
                        @else
                        @if(Auth::user()->volunteer)
                        <a href={{"/game/{$g->id}/edit"}}>
                        <button  type="button" class="btn">Edit</button>
                        </a>
                        @endif
                        @endguest

                        <a href={{"/game/{$g->id}"}} style="text-decoration:  none; color: black;"></a></div>
                @endif 
              @endforeach
  </table>
@endif
@endsection