<?php
/**
 * Author M. Atoar Rahman
 * Date: 01/02/2021
 * Time: 03:40 PM
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('date');
            $table->string('time_from')->nullable();
            $table->string('time_to')->nullable();
            $table->string('new_date');
            $table->string('new_time_from')->nullable();
            $table->string('new_time_to')->nullable();
            $table->string('topics');
            $table->tinyInteger('type')->default(0)->comment("0=self/1=minister/2=mp");
            $table->tinyInteger('status')->default(0)->comment("0=pending/1=approved/2=rejected");
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->nullable();
            $table->bigInteger('requested_to')->unsigned();
            $table->foreign('requested_to')->references('id')->on('profiles');
            $table->string('place')->nullable();
            $table->string('new_place')->nullable();
            $table->string('rejected_reason')->nullable();
            $table->integer('ministry_id')->default(0);
            $table->bigInteger('citizen_id')->nullable();
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
        Schema::dropIfExists('appointments');
    }
}
