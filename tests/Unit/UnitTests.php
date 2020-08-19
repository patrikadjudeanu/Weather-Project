<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Request;
use App\Exceptions;
use DatabaseMigrations;

class ExampleTest extends TestCase
{
    /**  
     * @dataProvider locationParamsProvider
     * @test
     */
    public function convert_request_location_params($lat, $lon)
    {
        $request = factory(App\Models\Request::class)->make([
            'latitude' => $a,
            'longitude' =>$b
        ]);
        $request->checkLocation();
        $this->assertNotEquals($a, $lat);
        $this->assertNotEquals($b, $lon);
    } 

    public function locationParamsProvider()
    {
        return [
            [90.1, 181],
            [-103, 360],
        ];
    }

    /**  
     * @test
     */
    public function no_last_temp_request_date()
    {
        $request = factory(App\Models\Request::class)->make();
        $location = $faker->city() . ', ' . $faker->country();

        $this->expectException(\RequestNotFoundException::class);

        $request->getLastTempRequestDate($location);
    }

    /**  
     * @test
     */
    public function test_api()
    {
        $request = factory(App\Models\Request::class)->make([
            'latitude' => 'abc',
            'longitude' => 23
        ]);

        $this->expectException(\APIException::class);
        $request->getWeatherData();
    }

    /**
     * @test
     */
    public function median_temp_invalid_date()
    {
        $statRequest = factory(App\Models\StatisticRequest::class)->make([
            'start_date' => '23-08-2012',
            'end_date' => '22-07-2009'
        ]);

        $request = factory(App\Models\Request::class)->make([
            'latitude' => 65,
            'longitude' => 49
        ]); 


        $this->expectException(\InvalidDataException::class);
        $statRequest->getMedianTemp($request);
    }
}
