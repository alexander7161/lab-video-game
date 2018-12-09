<div>
    @member
    <div class="card" style="margin-bottom:8px;">
        <div class="card-body" style="display:inline-block;">
            @if($renting)
            <div style="display: inline-block; ">
                @useridequals($renting[0]->iduser==Auth::id())
                <dt>Rented by:</dt>
                <dd style="margin-bottom:0;"> <a style="color:black;" href="/account">You</a></dd>
                @else
                <dt>Rented by:</dt>
                <dd style="margin-bottom:0;">
                    @volunteer <a style="color:black;" href="/account/{{$renting[0]->iduser}}">@endvolunteer
                         {{$renting[0]->username}}
                         @volunteer </a>@endvolunteer
                </dd>
                @enduseridequals </div>
            @endif @member @if($isavailable)
            <form style="display: inline-block; float:right;" method="POST" action="{{ route('rentgame', ['data' => array('idgame'=>$game->id)] ) }}">
                @csrf
                <input class="btn btn-outline-success" {{(!$isavailable? "disabled": "")}} type='submit' value="Rent it!" />
            </form>
            @else @useridequals($renting[0]->iduser)
            <form style="display: inline-block;float:right;" onSubmit="return confirm('Are you sure you want to return this item?');"
                method="POST" action="{{ route('unrentgame', ['data' => array('idgame'=>$game->id)] ) }}">
                @csrf
                <input class="btn btn-outline-danger" type='submit' value="Send Back!" />
            </form>
            @enduseridequals @endif @endmember
        </div>
    </div>
    @endmember

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Rental History</h5>
        </div>
        <div class="table-responsive">
            @if(sizeof($rentalhistory)>0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Start Date</th>
                        @if($renting)
                        <th scope="col">Due Date</th>@endif
                        <th scope="col">End Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rentalhistory as $r)
                    <tr class="@if(!$r->enddate) table-success @endif">
                        <td> {{$r->username}}</td>
                        <td>
                            <?php 
                                    $timestamp = strtotime($r->startdate);
                                        echo date("Y/m/d - H:i", $timestamp); ?> </td>
                        @if($renting)
                        <td>
                            <?php 
                            $timestamp = strtotime($r->duedate);
                                echo date("Y/m/d - H:i", $timestamp); ?> </td>@endif
                        <td>
                            <?php 
                                    if($r->enddate)  {
                                        $timestamp = strtotime($r->enddate);
                                    echo date("d-m-Y", $timestamp);
                                    }  else {
                                        echo "Currently Renting";
                                    }
                                 ?> </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="card-body">
                No Rental History. </div> @endif
        </div>
    </div>
</div>