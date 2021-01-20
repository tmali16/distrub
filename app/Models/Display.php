<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Display extends Model
{
    //

    public function prison()
    {
        return $this->belongsToMany('App\Prisions', 'display_prison', 'prison_id', 'display_id');
    }
}
