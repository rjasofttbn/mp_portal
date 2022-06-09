<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMpActivitiesStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mp_activities_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->integer('user_id')->unique();
			$table->tinyInteger('flat_status')->default(0);
			$table->tinyInteger('house_status')->default(0);
			$table->tinyInteger('telephone_status')->default(0);
            $table->tinyInteger('car_status')->default(0);
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('mp_activities_statuses');
    }
}
