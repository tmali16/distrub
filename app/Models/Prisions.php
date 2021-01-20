<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prisions extends Model
{
    public function displays()
    {
        return $this->belongsToMany('App\Models\Display', 'display_prisons', 'prision_id', 'display_id');
    }

    public function dvr()
    {
        return $this->hasMany('App\Models\VideoRecorder', 'prision_id', 'id');
    }
}
