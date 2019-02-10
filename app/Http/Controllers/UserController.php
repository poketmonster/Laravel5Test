<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Log;

class UserController extends Controller
{

    /**
     * Show the list of cities
     *
     * @return View
     */
    public function parametrize()
    {   
        return view('users.parametrize');
    }

    /**
     * Update user parameters
     *
     * @return View
     */
    public function saveParameters(Request $request){
        $parameters = ['temp40', 'temp30', 'temp20', 'temp10', 'temp0', 'temp-5', 'temp-10', 'temp-20', 'temp-21', 'wind8', 'wind17', 'clear', 'clouds', 'light_rain', 'heavy_rain', 'rain', 'drizzle', 'light_snow', 'heavy_snow', 'snow'];

        foreach($parameters as $param){
            session([$param => $request->get($param)]); 
        }

        return view('users.parametrize');
    }


}