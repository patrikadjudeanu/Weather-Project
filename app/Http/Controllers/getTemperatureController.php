<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GetTemperatureController extends Controller
{
    private $key = 'b541d7219b6c468eb87fea42f3c34e9b';

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
        $tempEntry->latitude = request('latitude');
        $tempEntry->longitude = request('longitude');

        $tempEntry->temperature = request('temperature');


        $tempEntry->save();
    }

    public static function getTemperature($lat, $long)
    {
        $endpoint =  'https://api.weatherbit.io/v2.0/current';
        $client = new \GuzzleHttp\Client();

    }
}
