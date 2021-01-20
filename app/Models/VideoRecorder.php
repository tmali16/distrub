<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class VideoRecorder extends Model
{
    protected $with = ['prision'];
    //

    public function prision()
    {
        return $this->hasOne(Prisions::class, 'id', 'prision_id');
    }
}
