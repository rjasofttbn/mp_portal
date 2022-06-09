<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petitions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('applicant_name', 255);
            $table->string('applicant_designation', 255);
            $table->string('applicant_nid');
            $table->string('applicant_mobile');
            $table->string('applicant_email', 255);
            
            $table->bigInteger('applicant_division_id')->unsigned();
            $table->bigInteger('applicant_district_id')->unsigned();
            $table->bigInteger('applicant_upazila_id')->unsigned();
            
            $table->string('applicant_union', 255);
            $table->string('applicant_more_address', 255)->nullable();
            
            $table->string('description', 255);
            $table->string('prayer', 255);

            $table->text('applicant_list');
            
            // $table->string('multi_name', 255);
            // $table->string('signature', 255);
            // $table->string('division_id');
            // $table->string('district_id');
            // $table->string('upazila_id');
            // $table->string('union', 255);
            // $table->string('more_address', 255)->nullable();
            
            $table->bigInteger('mp_name')->unsigned();            
            $table->tinyInteger('status')->default(1);

            $table->bigInteger('otp_id')->unsigned();

            // $table->integer('created_by');
            $table->integer('updated_by')->nullable();

            $table->foreign('applicant_division_id')->references('id')->on('divisions');
            $table->foreign('applicant_district_id')->references('id')->on('districts');
            $table->foreign('applicant_upazila_id')->references('id')->on('upazilas');

            $table->foreign('mp_name')->references('user_id')->on('profiles');
            $table->foreign('otp_id')->references('id')->on('petition_otps');
    
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
        Schema::dropIfExists('petitions');
    }
}
