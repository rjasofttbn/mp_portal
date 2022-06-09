<?php

/*
 Author: Naziur Rahman
Date: 22/03/2021
 */


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccommodationBuildingsTable extends Migration
{
    
    public function up()
    {
        Schema::create('accommodation_buildings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('name_bn')->unique();
            $table->string('building_no')->unique();
            $table->string('total_floor');
            $table->bigInteger('area_id')->unsigned();            
            $table->bigInteger('accommodation_type_id')->unsigned()->default(1);         
            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('accommodation_type_id')->references('id')->on('accommodation_types');
            $table->softDeletes();
            $table->timestamps();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('accommodation_buildings');
    }
}
