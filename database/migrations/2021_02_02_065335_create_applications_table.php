<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            //$table->bigInteger('application_type_id')->unsigned();
            $table->bigInteger('area_id')->unsigned();
            $table->bigInteger('flat_id')->unsigned();
            $table->date('date');
            $table->integer('unit_size');
            $table->date('allocation_date');
            $table->string('subject');
            $table->text('cancel_reason')->nullable();
            $table->date('expected_cancel_date')->nullable();
            $table->date('cancel_approve_date')->nullable();
            $table->text('change_reason')->nullable();
            $table->date('expected_change_date')->nullable();
            $table->date('change_approve_date')->nullable();
            $table->text('description')->nullable();            
            $table->tinyInteger('status')->default(1)->comment("0=rejected/1=approved/2=pending");
            $table->char('appliction_type')->length(2)->default('N')->comment("N=New/C=Cancel/Ch=Change");
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
            //$table->foreign('application_type_id')->references('id')->on('application_types');
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
        Schema::dropIfExists('applications');
    }
}
