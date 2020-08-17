<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as Req;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index(Request $request)
    {
        $ip = $request->ip();
        $pos = self::getLocation($ip);

        $req = new Req();
        $req->latitude = $pos['lat'];
        $req->longitude = $pos['lon'];
        $data = $req->getWeatherData();

        Session::put('currentLocation', $data->city_name . ', ' . $data->country_code);
        Session::put('currentTemperature', $data->temp);

        return view('home');
    }

    public static function getLocation($clientIP)
    {
        $endpoint =  'http://api.ipstack.com/' . $clientIP;
        $client = new \GuzzleHttp\Client(['verify'  => false]);

        $response = $client->request('GET', $endpoint, ['query' => [
            'key' => config('apiKeys.ipstackKey')
        ]]);

        $statusCode = $response->getStatusCode();
        $content = json_decode($response->getBody(), false);

        $location['lat'] = $content->latitude;
        $location['lon'] = $content->longitude;

        return $location;
    }
}
