<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
			$table->bigIncrements('id');
            $table->string('subject');
            $table->string('notice_from');
            $table->string('to_ministry_id')->nullable();
            $table->string('to_wing_id')->nullable();
            $table->string('notice_to')->nullable();
            $table->tinyInteger('is_verbal')->nullable();
            $table->text('explanation')->nullable();
            $table->date('date')->nullable();
            $table->text('topic')->nullable();
            $table->text('bill_topic')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->integer('created_by');
            $table->integer('rd_no')->nullable();
            $table->integer('question_type')->nullable();
            $table->integer('parliament_session')->nullable();
            $table->unsignedBigInteger('parliament_session_id')->nullable();
            $table->integer('priority')->default(0);
            $table->string('submission_date')->nullable();
            $table->integer('acceptance_tag')->nullable()->comment('1. Acceptable, 2. Acceptable with Correction');
            $table->float('acceptance_duration')->nullable()->comment('Total duration a MP can talk in Parliament')->default(0);
            $table->date('approval_date')->nullable();
            $table->text('comments')->nullable();
            $table->integer('ministry_id')->nullable()->default(0);
            $table->integer('speech_id')->nullable()->default(0);
            $table->integer('yes_no_vote')->nullable();
            $table->integer('mp_acceptance')->nullable();
            $table->string('discussed_date')->nullable();
            $table->string('mp_list')->nullable()->comment('selected MPs for Rule 68');
            $table->integer('updated_by')->nullable();
            //$table->bigInteger('rule_id')->unsigned();
            $table->bigInteger('rule_number')->unsigned();
            $table->integer('stage_number')->default(0);

            $table->foreign('parliament_session_id')->references('id')->on('parliament_sessions');
            //$table->foreign('rule_id')->references('id')->on('parliament_rules');
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
        Schema::dropIfExists('notices');
    }
}
