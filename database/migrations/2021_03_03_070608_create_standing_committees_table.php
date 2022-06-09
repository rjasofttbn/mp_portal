<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStandingCommitteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('standing_committees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parliament_id')->unique();
            $table->unsignedBigInteger('ministry_id')->unique();
            $table->string('user_id', 255);
            $table->string('designation', 255);
            $table->date('date_from');
            $table->date('date_to');
            $table->tinyInteger('status')->default(1);
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->foreign('parliament_id')->references('id')->on('parliaments');
            $table->foreign('ministry_id')->references('id')->on('ministries');
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
        Schema::dropIfExists('standing_committees');
    }
}
