<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMpattendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpattendances', function (Blueprint $table) {
            $table->id();
            $table->timestamp('date');
            $table->integer('mp_id');
            $table->integer('isPresent');
            $table->time('checkin_time');
            $table->time('checkout_time');
            $table->integer('created_by')->default(0);
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
        Schema::dropIfExists('mpattendances');
    }
}
