<?php

/*
Author: Naziur Rahman
Date: 22/03/2021

 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccommodationDepartmentApplicationsTable extends Migration
{
    public function up()
    {
        Schema::create('accommodation_department_applications', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('application_id')->unsigned()->nullable();
            $table->bigInteger('flat_id')->unsigned()->nullable();
            $table->date('allocated_date')->nullable();
            $table->bigInteger('status_id')->unsigned()->nullable();
            $table->longText('cancel_reason')->nullable();            
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->foreign('application_id')->references('id')->on('accommodation_applications'); 
            $table->foreign('flat_id')->references('id')->on('flats'); 
            $table->foreign('status_id')->references('id')->on('global_status');
            $table->softDeletes();         
            $table->timestamps();
          
          

        });
    }


    public function down()
    {
        Schema::dropIfExists('accommodation_department_applications');
    }
}
