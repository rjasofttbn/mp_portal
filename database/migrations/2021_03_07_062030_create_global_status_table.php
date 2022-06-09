<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlobalStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_status', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('status_type');
            $table->string('status_name');
            $table->string('name_bn');
            $table->tinyInteger('status_id');
            $table->string('status_color');
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
        Schema::dropIfExists('global_status');
    }
}
