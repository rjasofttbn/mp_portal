<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostelApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hostel_applications', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('subject');
            $table->string('application_from');
            $table->string('application_to')->nullable();
            $table->integer('approve_application_id')->nullable()->comment('mp request for cancel  / change this approved application');
            $table->date('date')->comment('MP submit date');
            $table->text('description')->nullable();
            $table->longText('cancel_reason_by_department')->nullable();
            $table->longText('cancel_reason_by_whip')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->integer('created_by');

            $table->string('department_ar_date')->nullable()->comment('Which Date Accept or Reject this application');
            $table->Integer('department_ar_by')->nullable()->comment('Which id Accept or Reject this application');
            $table->string('whips_ar_date')->nullable()->comment('Which Date Accept or Reject this application');
            $table->Integer('whips_ar_by')->nullable()->comment('Which id Accept or Reject this application');

            $table->text('comments')->nullable();
            $table->integer('updated_by')->nullable();
            $table->bigInteger('hostel_floor_id')->unsigned()->nullable();
            $table->bigInteger('hostel_building_id')->unsigned()->nullable();
           

            $table->bigInteger('hostel_application_type_id')->unsigned();

            $table->foreign('hostel_application_type_id')->references('id')->on('hostel_application_types');
            $table->foreign('hostel_floor_id')->references('id')->on('hostel_floors');
            $table->foreign('hostel_building_id')->references('id')->on('hostel_buildings');

            $table->bigInteger('office_room_id')->unsigned()->nullable();
            $table->foreign('office_room_id')->references('id')->on('office_rooms');
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
        Schema::dropIfExists('hostel_applications');
    }
}
