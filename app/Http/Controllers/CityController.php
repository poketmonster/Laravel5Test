<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;

use Log;
use App\City;

class CityController extends Controller
{

    /**
     * Show the list of cities
     *
     * @return View
     */
    public function listar()
    {   
        $cities = City::all();
        $max_score = 0;
        $max_score_city = NULL;
        foreach($cities as $city){
            $city->updatePrevision();
            if($city->lastPrevision()->score() > $max_score){
                $max_score = $city->lastPrevision()->score();
                $max_score_city = $city;
            }
        }
        Log::info('better city', array('city'=>$max_score_city));
        
        return view('cities.list', ['cities'=>$cities, 'best'=>$max_score_city]);
    }


}