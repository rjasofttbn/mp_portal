<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficeRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_rooms', function (Blueprint $table) {
            $table->id();
            $table->Integer('number');
            $table->string('number_bn');
            $table->bigInteger('building_id')->unsigned();
            $table->bigInteger('hostel_floor_id')->unsigned();
            $table->bigInteger('office_room_type_id')->unsigned()->nullable();
            $table->date('allocated_date')->nullable();
            $table->foreign('building_id')->references('id')->on('hostel_buildings');
            $table->foreign('hostel_floor_id')->references('id')->on('hostel_floors');
            $table->foreign('office_room_type_id')->references('id')->on('office_room_types');
            $table->tinyInteger('status')->default(1);
            $table->bigInteger('status_id')->unsigned()->default(15);
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->foreign('status_id')->references('id')->on('global_status');
            $table->softDeletes();
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
        Schema::dropIfExists('office_rooms');
    }
}
