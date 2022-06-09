<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostelFloorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hostel_floors', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('name');
            $table->string('name_bn');
            $table->integer('building_id')->unsigned();
            $table->tinyInteger('status')->length(1)->default(1);
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
           // $table->foreign('building_id')->references('id')->on('hostel_buildings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hostel_floors');
    }
}
