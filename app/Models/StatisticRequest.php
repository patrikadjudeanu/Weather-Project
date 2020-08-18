<?php

namespace App\Models;

use App\Models\Request;
use App\Exceptions\InvalidDataException;
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
        if($carbonFromDate->gt($carbonToDate))
            throw new InvalidDataException();

        $totalTemp = 0;
        $days = 0;
        while($carbonFromDate->lte($carbonToDate))
        {
            //Assuming getWeatherData() can return weather data for a specific day
            $totalTemp += $req->getWeatherData()->temp;


            $days++;
            $carbonFromDate->addDays(1);
        }
        
        return $totalTemp/$days;
    }

   
    /*
    getMedianTemp() assuming we have temperature request data for all the days since the last statisticRequest day:

    public function getMedianTemp(Request $req)
    {
        $carbonFromDate = Carbon::parse($this->start_date);
        $carbonToDate = Carbon::parse($this->end_date);

        if($carbonFromDate->gt($carbonToDate))
            throw new InvalidDataException();

        
        $totalTemp = 0;
        $days = 0;
        while($carbonFromDate->lte($carbonToDate))
        {
            $totalTemp += Request::where([
                                            ['location', '=', $this->location],
                                            ['requestable_type', '=', 'App\Models\StatisticRequest'],
                                            ['created_at', '=', $carbonFromDate]
                                        ])->first()->temperature;
    
            $days++;
            $carbonFromDate->addDays(1);
        }

        return $totalTemp/$days;
    }
    */
}
