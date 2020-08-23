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

    public function index()
    {
        return view('temperature');
    }   

    public function getTemperature()
    {
        try
        {
            $req = new Req();
            $req->latitude = request('latInput');
            $req->longitude = request('lonInput');
            $req->checkLocation();

            $data = $req->getWeatherData();
            $req->location = $data->city_name . ', ' . $data->country_code;
            $req->temperature = $data->temp;

            $tempRequest = new TemperatureRequest();
            $tempRequest->save();
            $tempRequest->requests()->save($req);

            return response()->json([
                'temp' => $data->temp,
                'city' => $data->city_name . ", " . $data->country_code
            ]);
        }
        catch(\Exception $ex)
        {
            return response()->json([
                'error' => true
            ]);
        }
    }

}
