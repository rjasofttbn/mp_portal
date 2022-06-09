<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticesLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice_log', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('notice_id');
            $table->text('previous_content');
            $table->text('current_content');
            $table->integer('previous_status');
            $table->integer('current_status');
            $table->text('comments')->nullable();
            $table->integer('changed_by');
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
        Schema::dropIfExists('notice_log');
    }
}
