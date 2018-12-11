<div class="card" style="margin-bottom:8px;">
    <div class="card-body">
        <h5 class="card-title">Rental History</h5>
    </div>
    <div class="table-responsive">
        @if(sizeof($games)>0)
        <table class="table table-striped" style="margin-bottom:0;">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">Due Date</th>
                    <th scope="col">End Date</th>
                    <th scope="col">Extensions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($games as $g)
                <tr class="@if($g->currentlyborrowed) table-success @endif">
                    <td>
                        <a style="color:black;" href="/game/{{$g->idgame}}">
                                        {{$g->name}}
                                    </a>
                    </td>
                    <td>
                        <?php 
                                        $timestamp = strtotime($g->startdate);
                                            echo date("Y/m/d - H:i", $timestamp); ?>
                    </td>
                    <td>
                        <?php 
                                            if($g->duedate)  {
                                                $timestamp = strtotime($g->duedate);
                                            echo date("Y/m/d - H:i", $timestamp);
                                            }  else {
                                                echo "-";
                                            }
                                         ?>
                    </td>
                    <td>
                        <?php 
                                        if($g->enddate)  {
                                            $timestamp = strtotime($g->enddate);
                                        echo date("Y/m/d - H:i", $timestamp);
                                        }  else {
                                            echo "-";
                                        }
                                     ?>
                    </td>
                    <td>
                        {{$g->extensions}}
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