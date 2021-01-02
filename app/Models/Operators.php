<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Operators extends Model
{
    use  SoftDeletes;
    //
    protected $hidden = [
        'rank_id',
    ];
    public function rank()
    {
        return $this->hasOne('App\Models\Rank', 'id', 'rank_id');
    }
}
