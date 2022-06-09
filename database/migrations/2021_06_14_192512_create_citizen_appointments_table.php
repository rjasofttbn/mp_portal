<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitizenAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citizen_appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('applicant_name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('email');
            $table->string('nid_num');
            $table->string('mobile_num');
            $table->string('c_address');
            $table->string('p_address');
            $table->bigInteger('otp_id')->unsigned();

            $table->foreign('otp_id')->references('id')->on('petition_otps');
    
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
        Schema::dropIfExists('citizen_appointments');
    }
}
