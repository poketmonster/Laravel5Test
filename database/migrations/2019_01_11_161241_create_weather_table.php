<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeatherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('previsions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('city_id');
            $table->integer('dt');
            $table->decimal('temp', 5, 2);
            $table->decimal('temp_min', 5, 2);
            $table->decimal('temp_max', 5, 2);
            $table->integer('pressure');
            $table->integer('humidity');
            $table->decimal('wind_speed', 5, 2);
            $table->integer('wind_deg');
            $table->string('main', 50)->charset('utf8');
            $table->string('description', 500)->charset('utf8');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('previsions');
    }
}
