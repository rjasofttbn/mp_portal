<?php

/* 
Author: Naziur Rahman 
Date: 22/03/2021
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseBuildingsTable extends Migration
{
  
    public function up()
    {
        Schema::create('house_buildings', function (Blueprint $table) {
            $table->id();

            
            $table->string('name')->unique();
            $table->string('name_bn')->unique();
            $table->string('building_no')->unique();
            $table->bigInteger('accommodation_type_id')->unsigned()->default(2);        
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->bigInteger('area_id')->unsigned();            
            $table->softDeletes();
            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('accommodation_type_id')->references('id')->on('accommodation_types');
            $table->timestamps();
        });
    }

  
    public function down()
    {
        Schema::dropIfExists('house_buildings');
    }
}
