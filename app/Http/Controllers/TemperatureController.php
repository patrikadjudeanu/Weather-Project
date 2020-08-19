<?php

namespace App\Http\Controllers;

use App\Models\TemperatureRequest;
use App\Models\Request as Req;
use Illuminate\Http\Request;
use \Session;
use App\Exceptions\APIException;

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
            try
            {
                $latitude = request('latInput');
                $longitude = request('lonInput');

                $req = new Req();
                $req->latitude = $latitude;
                $req->longitude = $longitude;
                $req->checkLocation();

                $weatherData = $req->getWeatherData();
                $req->temperature = $weatherData->temp;
                $req->location = $weatherData->city_name . ', ' . $weatherData->country_code;

                $tempRequest = new TemperatureRequest();
                $tempRequest->save();
                $tempRequest->requests()->save($req);


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
