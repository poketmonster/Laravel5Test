<?php

namespace App;

use Log;
use App\Weather;

use Illuminate\Database\Eloquent\Model;


class Prevision extends Model
{
    public function weathers()
    {
        return $this->hasMany('App\Weather');
    }

    public function city()
    {
        return City::find($this->city_id);
    }

    /**
     * Calculate how good is the weather
     *
     * @return 
     * 
     */
    public function score(){
        //Log::info('Calculating score', array('city'=>$this->city()->name));
        $score = 0;

        //Check temperature ranges
        if($this->temp>40){
            $score += session('temp40', -2);
        }elseif($this->temp>30){
            $score += session('temp30', 2);
        }elseif($this->temp>20){
            $score += session('temp20', 1);
        }elseif($this->temp>10){
            $score += session('temp10', 0);
        }elseif($this->temp>0){
            $score += session('temp0', 0);
        }elseif($this->temp>-5){
            $score += session('temp-5', -1);
        }elseif($this->temp>-10){
            $score += session('temp-10', -2);
        }elseif($this->temp>-20){
            $score += session('temp-20', -4);
        }elseif($this->temp<=-20){
            $score += session('temp-21', -5);
        }
        Log::info('Score including temp', array('sc'=>$score));

        //Check wind
        if($this->wind_speed>=8 && $this->wind_speed<=17){
            $score += session('wind8', -1);
        }if($this->wind_speed>17){
            $score += session('wind17', -2);
        }
        Log::info('Score including wind', array('sc'=>$score));

        //Check weather code
        $total_weathers=0;
        foreach($this->weathers()->get() as $weather){
            Log::info('Check weather', array('desc'=>$weather->description));

            //clear sky
            if(strpos($weather->description, 'sky')){
                $score += session('clear', 2);
                Log::info('Score including clear sky', array('sc'=>$score));
            }

            //clouds
            if(strpos($weather->description, 'clouds')){
                $score += session('clouds', 0);
                Log::info('Score including clouds', array('sc'=>$score));
            }
            

            //rain
            if(strpos($weather->description, 'rain')){
                //light
                if(strpos($weather->description, 'light')){
                    $score += session('light_rain', -1);
                }
                //heavy
                elseif(strpos($weather->description, 'heavy')){
                    $score += session('heavy_rain', -3);
                }
                //regular
                else{
                    $score += session('rain', -2);
                }
                Log::info('Score including raing', array('sc'=>$score));
            }
            

            //Drizzle - only if weather not includes rain word
            if(strpos($weather->description, 'drizzle') && !strpos('rain', $weather->description)){
                $score += session('drizzle', -1);
                Log::info('Score including drizzle', array('sc'=>$score));
            }
            


            //snow
            if(strpos($weather->description, 'snow')){
                //light
                if(strpos($weather->description, 'light')){
                    $score += session('light_snow', 1);
                }
                //heavy
                elseif(strpos($weather->description, 'heavy')){
                    $score += session('heavy_snow', -3);
                }
                //regular
                else{
                    $score += session('snow', -1);
                }
                Log::info('Score including snow', array('sc'=>$score));
            }


        }
        return $score;
    }

}
