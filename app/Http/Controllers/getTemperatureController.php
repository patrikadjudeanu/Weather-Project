<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Temperature;
use App\Http\Controllers\GetTemperatureController;

class GetTemperatureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('getTemperature');
    }   

    public function store()
    {
        $tempEntry = new Temperature();
        $tempEntry->latitude = request('latInput');
        $tempEntry->longitude = request('lonInput');

        if($tempEntry->latitude > 90)
            $tempEntry->latitude %= 90;
        else if($tempEntry->latitude < -90)
            $tempEntry->latitude %= -90;
        
        if($tempEntry->longitude > 180)
            $tempEntry->longitude %= 180;
        else if($tempEntry->longitude < -180)
            $tempEntry->longitude %= -180;   
        
        $tempEntry->temperature = GetTemperatureController::getData($tempEntry->latitude, $tempEntry->longitude)->temp;       

        $tempEntry->save();

        $location = GetTemperatureController::getData($tempEntry->latitude, $tempEntry->longitude)->city_name;


        return view('getTemperature', ['location' => $location,
                                        'temp' => $tempEntry->temperature]);
    }

    public static function getData($lat, $long)
    { 
        //getting cURL data with guzzle

        $endpoint =  'https://api.weatherbit.io/v2.0/current';
        $client = new \GuzzleHttp\Client(['verify'  => false]);

        $response = $client->request('GET', $endpoint, ['query' => [
            'lat' => $lat, 
            'lon' => $long,
            'key' => config('apiKeys.weatherbitKey')
        ]]);

        $statusCode = $response->getStatusCode();
        $content = json_decode($response->getBody(), false);
        
        return $content->data['0'];
    }

}
