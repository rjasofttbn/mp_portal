<?php

/*
 Author: Naziur Rahman
 Date: 6/05/2021
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccommodationApplicationTypesTable extends Migration
{
   
    public function up()
    {
        Schema::create('accommodation_application_types', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('name');
            $table->string('name_bn');
            $table->bigInteger('accommodation_type_id')->unsigned();
            $table->foreign('accommodation_type_id')->references('id')->on('accommodation_types');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('accommodation_application_types');
    }
}