<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = ['latitude', 'longitude', 'temperature', 'location', 'requestable_id', 'requestable_type'];

    protected  $table = ('requests');

    const UPDATED_AT = null;

   

    public function requestable()
    {
        return $this->morphTo();
    }

    public function checkLocation()
    {
        if($this->latitude > 90)
            $this->latitude %= 90;
        else if($this->latitude < -90)
            $this->latitude %= -90;
        
        if($this->longitude > 180)
            $this->longitude %= 180;
        else if($this->longitude < -180)
            $this->longitude %= -180; 
    }

    public static function getLastRequestDate($location)
    {
        $counter = Request::where('location', $location)->count();

        if($counter == 0)
            return null;

        $lastEntryDate = strtotime(Request::latest()->first()->created_at);

        return date('Y-m-d', $lastEntryDate);
    }

    public function getWeatherData()
    { 
        $endpoint =  'https://api.weatherbit.io/v2.0/current';
        $client = new \GuzzleHttp\Client(['verify'  => false]);

        $response = $client->request('GET', $endpoint, ['query' => [
            'lat' => $this->latitude , 
            'lon' => $this->longitude ,
            'key' => config('apiKeys.weatherbitKey')
        ]]);

        $statusCode = $response->getStatusCode();
        $content = json_decode($response->getBody(), false);

        return $content->data['0'];
    }

}
