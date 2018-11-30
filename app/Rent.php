<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Database\Eloquent\Builder;

class Rent extends Model
{
    protected $table = 'rentals';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'idgame', 'idmember', 'startdate', 'enddate'
    ];
}
