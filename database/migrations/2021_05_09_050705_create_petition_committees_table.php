<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetitionCommitteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petition_committees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parliament_id');
            $table->date('date_from');
            $table->date('date_to');
            $table->string('user_id', 255);
            $table->string('designation_id', 255);
            $table->string('member_status', 255);
            $table->integer('quorum');
            $table->tinyInteger('status')->default(1);
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->foreign('parliament_id')->references('id')->on('parliaments');
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
        Schema::dropIfExists('petition_committees');
    }
}
