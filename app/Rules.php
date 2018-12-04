<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rules extends Model
{
    protected $table = 'rules';
    protected $primaryKey = null;
    public $timestamps = false;
    protected $fillable = [
        'rentgamelimit', 'rentalperiod', 'extensionlimit',
        'ruleviolimitperperiod', 'rulevioperiod',
        'banperiod'
    ];
    
}
