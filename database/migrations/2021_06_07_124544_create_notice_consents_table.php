<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticeConsentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice_consents', function (Blueprint $table) {
            $table->id();
            $table->integer('notice_id');
            $table->integer('user_id');
            $table->integer('stage_number');
            $table->text('note')->nullable();
            $table->tinyInteger('user_consent');
            $table->integer('created_by');
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
        Schema::dropIfExists('notice_consents');
    }
}
