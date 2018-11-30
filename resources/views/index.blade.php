@extends('layouts.app') {{-- 
@section('script')
<script type="text/javascript">
    ReactDOM.render(<Example/>, document.getElementById('example'));
</script>
@endsection
 --}} 
@section('content') {{--
<div id="example"></div> --}} @if ($games)
<div class="card-columns">
    @foreach ($games as $g)
    <div class="card" style="max-width: 22rem;">
        {{-- <img class="card-img-top" src=".../100px180/" alt="Card image cap"> --}}
        <div class="card-body">
            <h5 class="card-title"> {{ $g->name }}</h5>

            {{--
            <p class="card-text">

            </p> --}}
        </div>
        @guest @else @if(Auth::user()->volunteer)
        <a href={{ "/game/{$g->id}/edit"}}>
                                        <button  type="button" class="btn">Edit</button>
</a> @endif @endguest
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