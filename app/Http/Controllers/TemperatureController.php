<?php

namespace App\Http\Controllers;

use App\Models\TemperatureRequest;
use App\Models\Request as Req;
use Illuminate\Http\Request;
use \Session;

class TemperatureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->isMethod('get'))
            return view('temperature');
        else if($request->isMethod('post'))
        {
            $tempRequest = new TemperatureRequest();
            $tempRequest->save();

            $latitude = request('latInput');
            $longitude = request('lonInput');

            $req = new Req();
            $req->latitude = $latitude;
            $req->longitude = $longitude;
            $req->checkLocation();

            $weatherData = $req->getWeatherData();
            $req->temperature = $weatherData->temp;
            $req->location = $weatherData->city_name . ', ' . $weatherData->country_code;

            $tempRequest->requests()->save($req);


            Session::flash('city', $req->location); 
            Session::flash('temp', $req->temperature); 
            return redirect()->back();
        }
    }   

}
