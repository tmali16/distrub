<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distrub extends Model
{
    //

    protected $with = [
        'media', 'operator.rank', 'prision', 'service', 'distrubType'
    ];

    public function media()
    {
        return $this->belongsToMany('App\Models\Media', 'distrub_media');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
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
        return $this->hasOne('App\Models\Services', 'id', 'serviced');
    }
    public function distrubType()
    {
        return $this->hasOne("App\Models\DistrubType", "id", "distrub_type");
    }
}
