<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'game';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'name', 'releaseyear', 'type',
        'description', 'platform',
        'rating', 'imageurl'
    ];
}
