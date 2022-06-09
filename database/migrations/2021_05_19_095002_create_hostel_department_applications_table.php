<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHostelDepartmentApplicationsTable extends Migration
{
    
    public function up()
    {
        Schema::create('hostel_department_applications', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('application_id')->unsigned()->nullable();
            $table->bigInteger('office_room_id')->unsigned()->nullable();
            $table->date('allocated_date')->nullable();
            $table->bigInteger('status_id')->unsigned()->nullable();
            $table->longText('cancel_reason')->nullable();            
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->foreign('application_id')->references('id')->on('hostel_applications'); 
            $table->foreign('office_room_id')->references('id')->on('office_rooms'); 
            $table->foreign('status_id')->references('id')->on('global_status');
            $table->softDeletes(); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hostel_department_applications');
    }
}
