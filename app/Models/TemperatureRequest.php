<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemperatureRequest extends Model
{
    protected  $table = ('temperature_requests');
    public $timestamps = false;


    public function requests()
    {
        return $this->morphOne('App\Models\Request', 'requestable');
    }

}
