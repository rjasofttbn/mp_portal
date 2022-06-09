<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccommodationAssetPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodation_asset_packages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('accommodation_type_id')->unsigned();
            $table->bigInteger('flat_type_id')->nullable();

            $table->string('accommodation_asset_type_id', 300);
            $table->string('accommodation_asset_id', 300);
            $table->string('total_no', 300);

            $table->foreign('accommodation_type_id')->references('id')->on('accommodation_types');
            
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
        Schema::dropIfExists('accommodation_asset_packages');
    }
}
