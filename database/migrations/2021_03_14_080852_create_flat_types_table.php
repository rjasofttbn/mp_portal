<?php

 /*
Author: Naziur Rahman
Date: 22/03/2021

 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlatTypesTable extends Migration
{
    public function up()
    {
        Schema::create('flat_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_bn')->unique();
            $table->string('name')->unique();
            $table->integer('size');
            $table->float('service_charge');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('flat_types');
    }
}
