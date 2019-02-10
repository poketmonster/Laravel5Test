<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\City;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class PrevisionTest extends TestCase
{
    /**
     * Test JSON api works for any city in bbdd
     *
     * @return void
     */
    public function testAPIworks()
    {
        foreach(City::all() as $city){
            $client = new Client(); //GuzzleHttp\Client
            if($city->owm_id){  
                $uri = "http://api.openweathermap.org/data/2.5/weather?id=".$city->owm_id."&units=metric&APPID=".Config('parameters.apikey');
            }else{
                $uri = "http://api.openweathermap.org/data/2.5/weather?q=".$city->name."&units=metric&APPID=".Config('parameters.apikey');
            }

            $result = $client->get($uri);
            $this->assertTrue($result->getStatusCode() == 200);
        }
    }
}
