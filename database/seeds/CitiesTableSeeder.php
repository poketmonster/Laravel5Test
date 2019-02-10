<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        //Cities
        $cities=['Valencia', 'New York', 'Prudhoe Bay', 'Tbilisi', 'Bangui'];

        //Load openweathermap json of available cities
        $path = storage_path() . "/json/city.list.json";
        $jsoncities = json_decode(file_get_contents($path), true); 
        $cityindex = array_column($jsoncities, NULL, 'name');

        foreach($cities as $city){
            DB::table('cities')->insert([
                'name' => $city
            ]);
            
        }
        
    }
}
