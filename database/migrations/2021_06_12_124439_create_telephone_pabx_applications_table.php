<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelephonePabxApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telephone_pabx_applications', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('connection_type')->comment('1=>telephone','2=>pabx');
            $table->tinyInteger('connection_place')->comment('1=>official','2=>residential');
            $table->tinyInteger('require_connection_place')->comment('1=>songsod','2=>own')->nullable();
            $table->string('own_address')->nullable();
            $table->tinyInteger('building_type')->nullable();
            $table->string('block_id')->nullable();
            $table->string('floor_id')->nullable();
            $table->string('room_id')->nullable();
            $table->tinyInteger('want_renew')->comment('1=>yes','2=>no');
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->nullable();
            $table->integer('status')->default(0)->comment('0=>pending','1=>acceept');
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
        Schema::dropIfExists('telephone_pabx_applications');
    }
}
