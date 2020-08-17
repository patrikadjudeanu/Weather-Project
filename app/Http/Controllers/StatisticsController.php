<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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

    //TODO: FIX BUG!

    public function index(Request $request)
    {
        if ($request->isMethod('get'))
            return view('statistics');
        else if($request->isMethod('post'))
        {
            //TODO: FIX BUG
            $fromDate = '2020-01-01';
            $toDate = date('Y-m-d');

            $req = new Req();
            $req->latitude = request('latInput');
            $req->longitude = request('lonInput');
            $req->checkLocation();

            $weatherData = $req->getWeatherData();
            $req->location = $weatherData->city_name . ', ' . $weatherData->country_code;
            if(Req::getLastRequestDate($req->location) != null)
            {
                $fromDate = Req::getLastRequestDate($req->location);
                Session::flash('lastRequest', $fromDate);
            }
            else
                Session::flash('requestNotFound', true);
            
            $statRequest = new StatisticRequest();
            $statRequest->start_date = $fromDate;
            $statRequest->end_date = $toDate;
            $statRequest->save();

            $req->temperature = $statRequest->getMedianTemp($req);
            $statRequest->requests()->save($req);

            Session::flash('city', $req->longitude); 
            Session::flash('temp', $req->latitude); 
            return redirect()->back();
        }
    }

    
}
