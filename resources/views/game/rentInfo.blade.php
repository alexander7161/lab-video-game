<?php
$bg = "bg-success";
if(sizeof($renting)>0) {
    $bg = "bg-secondary";
}
if(sizeof($renting)>0 && $renting[0]->iduser==Auth::id()) {
    $bg = "bg-dark";
}
if(!$isavailable) {
    $renting = $renting[0];
}
?>
    <div class="card {{$bg}} text-white" style="margin-bottom:8px;">
        <div class="card-body" style="padding-bottom: 4px;padding-left:15px;">
            <h5 class="card-title">@if(!$isavailable) @useridequals($renting->iduser==Auth::id()) Currently Rented by <a style="color:inherit;"
                    href="/account">You</a> @else Currently Rented by @volunteer <a style="color:inherit;" href="/account/{{$renting->iduser}}">@endvolunteer
                     {{$renting->username}}
                     @volunteer </a>@endvolunteer @enduseridequals @else Available @endif</h5>
        </div>
        @if(!$isavailable)
        <div class="container">
            <div class="row">
                <div class="col">
                    <dl>
                        <dt>Start Date:</dt>
                        <dd>
                            <?php
                        $timestamp = strtotime($renting->startdate);
                        echo date("d/m/Y", $timestamp) ." at ".date("H:i", $timestamp);
                    ?>
                        </dd>

                    </dl>
                </div>
                <div class="col">
                    <dl>
                        <dt>Due Date:</dt>
                        <dd>
                            <?php
                            $timestamp = strtotime($renting->duedate);
                            echo date("d/m/Y", $timestamp) ." at ".date("H:i", $timestamp);
                        ?>
                        </dd>
                    </dl>
                </div>
                <div class="col">
                    <dl>
                        <dt>Extensions:</dt>
                        <dd>
                            {{$renting->extensions}}
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        @endif
        <div class="card-footer" style="color:lightgray;padding-left:15px;">
            @if(!$isavailable)
            <p style="display:inline-block;margin-bottom:0;"> Due in
                <?php
                $timestamp = strtotime($renting->duedate);
                $duedate = date("Y-m-d H:i:s", $timestamp);
                $diff= date_diff(new DateTime($duedate), new DateTime());
                echo $diff->format('%a days');
        ?>
            </p> @endif
            <div style="float:right;display:inline-block;">
                @broken($game->id) The item is broken and must be refunded @else @userowesrefund You must refund your broken game first @else
                @member @if($isavailable)
                <form style="display: inline-block;" method="POST" action="{{ route('rentgame', ['data' => array('idgame'=>$game->id)] ) }}">
                    @csrf
                    <input class="btn btn-light" {{(!$isavailable? "disabled": "")}} type='submit' value="Rent it!" />
                </form>
                @else @useridequals($renting->iduser) @underrentgamelimit($renting->extensions)
                <form style="display: inline-block;" action="/addextension/{{$renting->rentalid}}" method="GET">
                    @csrf
                    <input class="btn btn-light" type='submit' value="Get Extension" />
                </form>
                @endunderrentgamelimit
                <form style="display: inline-block;" onSubmit="return confirm('Are you sure you want to return this item?');" method="POST"
                    action="{{ route('unrentgame', ['data' => array('idrent'=>$renting->rentalid)] ) }}">
                    @csrf
                    <input class="btn btn-danger" type='submit' value="Send Back!" />
                </form>
                @enduseridequals @endif @endmember @enduserowesrefund @endbroken
            </div>
        </div>
    </div>