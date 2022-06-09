<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccommodationApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodation_applications', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('approve_application_id')->nullable()->comment('This is approved application id , When you will change or cancel flat');
            $table->bigInteger('area_id')->unsigned()->nullable();
            $table->bigInteger('house_building_id')->unsigned()->nullable();
            $table->bigInteger('accommodation_building_id')->unsigned()->nullable();
            $table->bigInteger('application_type_id')->unsigned();
            $table->bigInteger('flat_type_id')->unsigned()->nullable();
            $table->bigInteger('flat_id')->unsigned()->nullable();
            $table->bigInteger('floor_id')->unsigned()->nullable();
            
            $table->date('date')->nullable();
            $table->text('description')->nullable();
            $table->longText('cancel_reason')->nullable();
            $table->longText('cancel_reason_by_whip')->nullable();
            
            $table->date('department_ar_date')->nullable()->comment('Which Date Accept or Reject this application');
            $table->integer('department_ar_by')->nullable()->comment('Which id Accept or Reject this application');
            $table->string('whips_ar_date')->nullable()->comment('Which Date Accept or Reject this application');
            $table->integer('whips_ar_by')->nullable()->comment('Which id Accept or Reject this application');
            
            $table->foreign('area_id')->references('id')->on('areas');
            $table->foreign('house_building_id')->references('id')->on('house_buildings');
            $table->foreign('accommodation_building_id')->references('id')->on('accommodation_buildings');
            $table->foreign('application_type_id')->references('id')->on('accommodation_application_types');
            $table->foreign('flat_type_id')->references('id')->on('flat_types');
            $table->foreign('flat_id')->references('id')->on('flats');
            $table->foreign('floor_id')->references('id')->on('floors');
            $table->text('comments')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0=draft , 1=create, 2= department_approved,3=department_reject,4=whip_approve,5=whip_reject    ');
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accommodation_applications');
    }
}
