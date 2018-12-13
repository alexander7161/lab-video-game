<?php
$u = $user;
?>
    <div class="card {{$u->banned?" bg-danger text-white ": " "}} " style="margin-bottom:8px;">
        <div class="card-body">
            <h5 class="card-title" style="display: inline-block;">{{ $u->name }}</h5>@if($u->volunteer)
            <span class="badge badge-success">Volunteer</span>@endif @if($u->secretary)
            <span class="badge badge-warning">Secretary</span>@endif @if(!$u->volunteer)
            <form style="float:right;" action="/account/{{$u->id}}/{{$u->banned?'unban':'ban'}}" method="GET">
                <button type="submit" class="btn {{$u->banned? " btn-outline-light ":"btn-outline-dark "}}">{{$u->banned?"Unban" : "Ban" }}</button></form>
            @endif
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col-sm">
                            <dl>
                                <dt>Account created:</dt>
                                <dd>
                                    <?php 
                            $timestamp = strtotime($u->created_at);
                                echo date("d/m/Y - H:i", $timestamp); ?>
                                </dd>
                                @volunteer<dt>Banned:</dt>
                                <dd>
                                    {{$u->banned?"True":"False"}}
                                </dd>@endvolunteer
                            </dl>
                        </div>
                        @if($u->banned)
                        <div class="col-sm">
                            <dl>
                                <dt>Ban started:</dt>
                                <dd>
                                    <?php 
                                $timestamp = strtotime($ban[0]->datebanned);
                                    echo date("d/m/Y - H:i", $timestamp); ?>
                                </dd>
                                <dt>Ban ends:</dt>
                                <dd>
                                    <?php 
                                $timestamp = strtotime($ban[0]->banenddate);
                                    echo date("d/m/Y - H:i", $timestamp); ?>
                                </dd>
                            </dl>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(!$u->volunteer)
    <div class="card" style="margin-bottom:8px;">
        <div class="card-body">
            <h5 class="card-title" style="display: inline-block;">{{sizeof($violations)>0? "Violations" : "No Violations"}}</h5>
            @volunteer
            <form style="float:right;" action="/account/{{$u->id}}/addviolation" method="GET">
                <button type="submit" class="btn btn-outline-dark">Add Violation</button></form>
            @endvolunteer @if(sizeof($violations)>0)
            <table class="table table-striped" style="margin-bottom:0;">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Reason</th>
                        @volunteer
                        <th scope="col"></th>@endvolunteer
                    </tr>
                </thead>
                <tbody>
                    @foreach($violations as $v)
                    <tr>
                        <td>
                            <?php 
                                    $timestamp = strtotime($v->date);
                                        echo date("Y/m/d - H:i", $timestamp); ?>
                        </td>
                        <td>
                            {{$v->reason}}
                        </td>
                        @volunteer
                        <td>
                            <form action="/account/removeviolation/{{$v->id}}" method="GET">
                                <button type="submit" class="btn {{$u->banned? " btn-outline-danger ":"btn-outline-dark "}}">Remove Violation</button></form>
                        </td>@endvolunteer
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
    @endif