<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccommodationHostelStatusDetailsTable extends Migration
{
   
    public function up()
    {
        Schema::create('accommodation_hostel_status_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('flat_id')->unsigned()->nullable();
            $table->bigInteger('house_building_id')->unsigned()->nullable();
            $table->bigInteger('office_rooms_id')->unsigned()->nullable();
            $table->date('allocated_date')->nullable();
            $table->bigInteger('status_id')->unsigned()->nullable();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('flat_id')->references('id')->on('flats'); 
            $table->foreign('house_building_id')->references('id')->on('house_buildings');
            $table->foreign('office_rooms_id')->references('id')->on('office_rooms');
            $table->foreign('status_id')->references('id')->on('global_status');




            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('accommodation_hostel_status_details');
    }
}
