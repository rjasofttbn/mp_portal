<?php

/*
  Author: Naziur Rahman
  Date: 5/05/2021
  
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlatsTable extends Migration
{
   
    public function up()
    {
        Schema::create('flats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('number');
            $table->string('number_bn')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->bigInteger('status_id')->unsigned()->default(15);
            $table->bigInteger('floor_id')->unsigned()->nullable();
            $table->bigInteger('building_id')->unsigned()->nullable();
            $table->bigInteger('flat_type_id')->unsigned()->nullable();
            $table->bigInteger('area_id')->unsigned()->nullable();
            $table->foreign('floor_id')->references('id')->on('floors');
            $table->foreign('building_id')->references('id')->on('accommodation_buildings');
            $table->foreign('flat_type_id')->references('id')->on('flat_types');
            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('status_id')->references('id')->on('global_status');
            $table->softDeletes();
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('flats');
    }
}
