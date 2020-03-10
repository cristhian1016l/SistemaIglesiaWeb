<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CasaDePaz extends Model
{
    protected $table = "TabCasasDePaz";
    protected $primaryKey = "CodCasPaz";
    public $incrementing = false;
    public $timestamps = false;
}
