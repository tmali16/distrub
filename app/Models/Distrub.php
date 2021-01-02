<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distrub extends Model
{
    //


    public function file()
    {
        return $this->belongsToMany('App\Models\Distrub', 'distrub_files', 'media_id', 'distrub_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function operator()
    {
        return $this->hasOne("App\Models\Operators", "id", "operator_id");
    }

    public function prision()
    {
        return $this->hasOne('App\Models\Prisions', 'id', 'prision_id');
    }

    public function service()
    {
        return $this->hasOne('App\Models\Service', 'id', 'serviced');
    }
}
