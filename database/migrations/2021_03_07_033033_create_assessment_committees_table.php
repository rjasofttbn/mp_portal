<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentCommitteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment_committees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parliament_id');
            $table->string('user_id', 255);
            $table->string('designation', 255);
            $table->date('date_from');
            $table->date('date_to');
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
        Schema::dropIfExists('assessment_committees');
    }
}
