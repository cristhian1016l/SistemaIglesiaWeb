<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfCdp extends Model
{
    public $timestamps = false;
    protected $table = "TabInfCasPaz";
    protected $primaryKey = 'NumInf';
}
