<?php

namespace App\Models;

use App\Models\Request;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class StatisticRequest extends Model
{
    public $timestamps = false;
    protected  $table = ('statistic_requests');
    protected $filable = ['start_date', 'end_date'];
    protected $dates = ['start_date', 'end_date'];

    public function requests()
    {
        return $this->morphOne('App\Models\Request', 'requestable');
    }

    public function getMedianTemp(Request $req)
    {
        $carbonFromDate = Carbon::parse($this->start_date);
        $carbonToDate = Carbon::parse($this->end_date);

        $totalTemp = 0;
        $days = 0;
        while($carbonFromDate->lte($carbonToDate))
        {
            $totalTemp += $req->getWeatherData()->temp;
            $days++;
            $carbonFromDate->addDays(1);
        }
        
        return $totalTemp/$days;
    }

}
