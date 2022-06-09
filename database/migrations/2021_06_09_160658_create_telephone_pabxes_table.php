<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelephonePabxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telephone_pabxes', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('place_type')->comment('0=>office,1=>residential');
            $table->integer('designition_id');
            $table->integer('num_of_telephone')->nullable();
            $table->integer('num_of_pabx')->nullable();
            $table->integer('num_of_mobile')->nullable();
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('telephone_pabxes');
    }
}
