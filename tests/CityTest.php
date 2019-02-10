<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\City;

class CityTest extends TestCase
{
    /**
     * Check there's a recomended bagde
     *
     * @return void
     */
    public function testBadgeOnView()
    {   
        //Check there's a recomendation badge
        $this->visit('/')
             ->see(Lang::get('layout.recomended'));
    }

     /**
     * Check all cities apper on main view
     *
     * @return void
     */
    public function testCitiesOnVien()
    {
        //Check all cities appear on view
        foreach(City::all() as $city){
            $this->visit('/')
             ->see($city->name);
        }

        
        
    }
}
