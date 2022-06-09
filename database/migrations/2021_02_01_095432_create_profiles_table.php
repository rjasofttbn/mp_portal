<?php
/**
 * Author M. Atoar Rahman
 * Date: 01/02/2021
 * Time: 03:40 PM
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_bn');
            $table->string('name_eng');
            $table->string('father_name');
            $table->string('mother_name');
            $table->integer('merital_status')->default(1);
            $table->string('spouse_name_bn')->nullable();
            $table->string('spouse_name_eng')->nullable();
            $table->date('spouse_dob')->nullable();
            $table->bigInteger('nid_no');
            $table->bigInteger('spouse_nid_no')->nullable();
            $table->integer('religion')->default(1);
            $table->bigInteger('pabx_no')->nullable();
            $table->bigInteger('official_phone')->nullable();
            $table->bigInteger('residential_phone')->nullable();
            $table->string('office_address')->nullable();
            $table->string('residential_address')->nullable();
            $table->string('parmanent_address')->nullable();
            $table->tinyInteger('status')->default(1)->comment("1=pending/ 2=approved/ 3=rejected");
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->softDeletes();

            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('constituency_id')->unsigned();
            $table->bigInteger('parliament_id')->unsigned();
            $table->bigInteger('designation_id')->unsigned();
            $table->bigInteger('political_parties_id')->unsigned();
            $table->bigInteger('birth_district_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('constituency_id')->references('id')->on('constituencies');
            $table->foreign('parliament_id')->references('id')->on('parliaments');
            $table->foreign('designation_id')->references('id')->on('designations');
            $table->foreign('political_parties_id')->references('id')->on('political_parties');
            $table->foreign('birth_district_id')->references('id')->on('districts');
            $table->integer('ministry_id')->default(1);
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
        Schema::dropIfExists('profiles');
    }
}
