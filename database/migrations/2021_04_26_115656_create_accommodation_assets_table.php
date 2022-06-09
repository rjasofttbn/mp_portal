<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccommodationAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodation_assets', function (Blueprint $table) {
            $table->id();
            $table->longText('name');
            $table->string('name_bn')->unique();
            $table->bigInteger('accommodation_type_id')->unsigned();
            $table->bigInteger('accommodation_asset_type_id')->unsigned();
            $table->tinyInteger('status')->default(1);            
            $table->foreign('accommodation_type_id')->references('id')->on('accommodation_types');
            $table->foreign('accommodation_asset_type_id')->references('id')->on('accommodation_asset_types');
            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('accommodation_assets');
    }
}
