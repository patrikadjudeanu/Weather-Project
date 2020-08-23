<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatisticRequest;
use App\Models\TemperatureRequest;
use App\Models\Request as Req;
use \Session;
use Carbon\Carbon;

class StatisticsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function index()
    {
        return view('statistics');
    }   

    public function getStatistics()
    {
        try
        {
            $req = new Req();
            $req->latitude = request('latInput');
            $req->longitude = request('lonInput');
            $req->checkLocation();

            $data = $req->getWeatherData();
            $req->location = $data->city_name . ', ' . $data->country_code;

            $fromDate = Req::getLastTempRequestDate($req->location);
            $toDate = date('Y-m-d');
            
            $statRequest = new StatisticRequest();
            $statRequest->start_date = $fromDate;
            $statRequest->end_date = $toDate;
            
            $medianTemp = round($statRequest->getMedianTemp($req), 1);
            $req->temperature = $medianTemp;
            
            $statRequest->save();
            $statRequest->requests()->save($req);

            return response()->json([
                'temp' => $medianTemp,
                'city' => $req->location,
                'from' => $fromDate
            ]);
        }
        catch(\Exception $ex)
        {
            return response()->json([
                'error' => $ex
            ]);
        }
    }

    
}
