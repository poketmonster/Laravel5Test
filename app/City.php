<?php

namespace App;

use Log;
use App\Prevision;
use App\Weather;

use Illuminate\Database\Eloquent\Model;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class City extends Model
{
    /**
     * Get all previsions of the city
     *
     * @return prevission array
     */
    public function previsions()
    {
        return $this->hasMany('App\Prevision');
    }

    /**
     * Get actual prevision
     *
     * @return prevission
     */
    public function lastPrevision()
    {
        return $this->previsions()->orderBy('dt', 'desc')->first();
    }

    /**
     * Get static map image centered on city
     *
     * @return imagen url
     */
    public function map(){
        
        $url = "https://maps.googleapis.com/maps/api/staticmap?center=".$this->lat.",".$this->lon."&zoom=12&size=700x400&key=AIzaSyApTEJkKneFN6lnIsra1-01AYM5RU7hs_Y";

        return $url;
    }

     /**
     * Update weather forecast from OpenWeatherMap API
     *
     * @return bool
     * True -> acces and recovery information correctly
     * False -> Problem
     */
    public function updatePrevision(){
        //If there are updated previsions do nothing (not older than [minutesToRefresh] minutes - parameter defined in parameters config file)
        Log::info('Update weather prevision', array('city'=>$this->id));

        if($this->previsions()->count()>0){
            Log::info('Allready have prevision', array('old (minutes)'=>(time()-$this->previsions()->orderBy('dt', 'desc')->first()->dt)/60, 'param'=>Config('parameters.minutesToRefresh'), 'bigger?' =>(time()-$this->previsions()->orderBy('dt', 'desc')->first()->dt)/60 > Config('parameters.minutesToRefresh') ));
            if((time()-$this->previsions()->orderBy('dt', 'desc')->first()->dt)/60 < Config('parameters.minutesToRefresh') ){
                Log::info('Its actual, we don\'t update');
                return True;
            }
        }

        //Get new prevision
        $client = new Client(); //GuzzleHttp\Client
        if($this->owm_id){  
            $uri = "http://api.openweathermap.org/data/2.5/weather?id=".$this->owm_id."&units=metric&APPID=".Config('parameters.apikey');
        }else{
            $uri = "http://api.openweathermap.org/data/2.5/weather?q=".$this->name."&units=metric&APPID=".Config('parameters.apikey');
        }
        
        Log::info('Uri', array('u'=>$uri));
        try{
            $result = $client->get($uri);
            if($result->getStatusCode() != 200){
                Log::error('Error on prevision recovery, error on response', array('city'=>$this->id, 'response status'=>$result->getBody()));
                return False;
            }
            //Log::info('Peticio de insert a Carto', array('res'=>$res, 'url'=>$url));
        }catch(\Exception $e){
            Log::error('Error on prevision recovery cannot connect to API', array('city'=>$this->id, 'error'=>$e));
            return False;
        }

        //Recovery reply 
        $reply = json_decode($result->getBody());

        //If not done save lat and lon
        if(!$this->lat || !$this->lon){
            $this->lat = $reply->coord->lat;
            $this->lon = $reply->coord->lon;
            $this->save();
        }
        //If not done save open weather map id
        if(!$this->owm_id){
            $this->owm_id = $reply->id;
            $this->save();
        }

        //Save prevision
        Log::info('Update city results', array('city'=>$this->id, 'reply'=>$reply));

        $prev = new Prevision;
        $prev->city_id = $this->id;
        if(property_exists($reply, 'dt')) $prev->dt = $reply->dt;
        if(property_exists($reply, 'main')){
            if(property_exists($reply->main, 'temp')) $prev->temp = $reply->main->temp;
            if(property_exists($reply->main, 'temp_max')) $prev->temp_max = $reply->main->temp_max;
            if(property_exists($reply->main, 'temp_min')) $prev->temp_min = $reply->main->temp_min;
            if(property_exists($reply->main, 'pressure')) $prev->pressure = $reply->main->pressure;
        }
        if(property_exists($reply, 'wind')){
            if(property_exists($reply->wind, 'speed')) $prev->wind_speed = $reply->wind->speed;
            if(property_exists($reply->wind, 'deg')) $prev->wind_deg = $reply->wind->deg;
        }
        $prev->save();

        foreach ($reply->weather as $weather){
            $new_weather = new Weather;
            $new_weather->prevision_id = $prev->id;
            if(property_exists($weather, 'id')) $new_weather->owm_id = $weather->id;
            if(property_exists($weather, 'main')) $new_weather->main = $weather->main;
            if(property_exists($weather, 'description')) $new_weather->description = $weather->description;
            $new_weather->save();
        }

        Log::info('City prevission has been updated');
        return True;

    }

    
}
