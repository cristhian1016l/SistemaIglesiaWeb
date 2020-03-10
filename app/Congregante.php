<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Congregante extends Model
{
    protected $table = "TabCon";

    protected $primaryKey = "CodCon";

    public function TabRedes()
    {
        return $this->belongsTo('App\Red', 'ID_RED');
    }
}
