<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficeWiseTelephonePabxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_wise_telephone_pabxes', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('building_type')->comment('0=>Hostel,1=>Songshod');
            $table->integer('block_id');
            $table->integer('floor_id');
            $table->integer('room_id');
            $table->integer('num_of_telephone')->nullable();
            $table->integer('status_telephone')->default(1);
            $table->integer('num_of_pabx')->nullable();
            $table->integer('status_pabx')->default(1);
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('office_wise_telephone_pabxes');
    }
}
