<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFurnitureElectronicGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('furniture_electronic_goods', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('area_id')->unsigned();
            $table->bigInteger('accommodation_type_id')->unsigned();
            $table->bigInteger('accommodation_building_id')->unsigned()->nullable();
            $table->bigInteger('accommodation_asset_type_id')->unsigned();
            $table->bigInteger('accommodation_asset_id')->unsigned();

            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('accommodation_type_id')->references('id')->on('accommodation_types');
            $table->foreign('accommodation_building_id')->references('id')->on('accommodation_buildings');
            $table->foreign('accommodation_asset_type_id')->references('id')->on('accommodation_asset_types');
            $table->foreign('accommodation_asset_id')->references('id')->on('accommodation_assets');

            $table->integer('total_no');
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('furniture_electronic_goods');
    }
}
