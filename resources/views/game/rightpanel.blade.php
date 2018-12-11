<div>
    @member
    @include('game.rentInfo', ['game' => $game, 'renting' => $renting, 'isavailable' => $isavailable]) @endmember

    <div class="card" style="margin-bottom:8px;">
        <div class="card-body">
            <h5 class="card-title">Rental History</h5>
        </div>
        <div class="table-responsive">
            @if(!$isavailable)
            <table class="table table-striped" style="margin-bottom:0;">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rentalhistory as $r)
                    <tr class="@if(!$r->enddate) table-success @endif">
                        <td>
                            @volunteer<a style="color:black;" href="/account/{{$r->iduser}}">@endvolunteer
                                    {{$r->username}}
                                @volunteer</a>@endvolunteer
                        </td>
                        <td>
                            <?php 
                                    $timestamp = strtotime($r->startdate);
                                        echo date("Y/m/d - H:i", $timestamp); ?>
                        </td>
                        <td>
                            <?php 
                                    if($r->enddate)  {
                                        $timestamp = strtotime($r->enddate);
                                    echo date("Y/m/d - H:i", $timestamp);
                                    }  else {
                                        echo "Currently Renting";
                                    }
                                 ?>
                        </td>
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