<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatisticRequest;
use App\Models\TemperatureRequest;
use App\Models\Request as Req;
use \Session;

class StatisticsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    

    public function index(Request $request)
    {
        if ($request->isMethod('get'))
            return view('statistics');
        else if($request->isMethod('post'))
        {
            try
            {
                $toDate = date('Y-m-d');

                $req = new Req();
                $req->latitude = request('latInput');
                $req->longitude = request('lonInput');
                $req->checkLocation();

                $weatherData = $req->getWeatherData();
                $req->location = $weatherData->city_name . ', ' . $weatherData->country_code;
                
                $fromDate = Req::getLastTempRequestDate($req->location);

                $statRequest = new StatisticRequest();
                $statRequest->start_date = $fromDate;
                $statRequest->end_date = $toDate;
                $statRequest->save();

                $req->temperature = $statRequest->getMedianTemp($req);
                $statRequest->requests()->save($req);

                Session::flash('lastRequest', $fromDate);
                Session::flash('city', $req->location); 
                Session::flash('temp', $req->temperature); 
            }
            catch(\Exception $ex)
            {
                Session::flash('errorMsg', $ex->errorMessage());
            }
            finally
            {
                return redirect()->back();
            }
        }
    }

    
}
