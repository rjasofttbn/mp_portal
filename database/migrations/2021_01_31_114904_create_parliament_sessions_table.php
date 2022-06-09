<?php
/**
 * Author M. Atoar Rahman
 * Date: 31/01/2021
 * Time: 05:40 PM
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParliamentSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parliament_sessions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('session_no');
            $table->date('declare_date');
            $table->date('date_from');
            $table->date('date_to');
            $table->tinyInteger('status')->default(1);
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->softDeletes();

            $table->bigInteger('parliament_id')->unsigned();

            $table->foreign('parliament_id')->references('id')->on('parliaments');
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
        Schema::dropIfExists('parliament_sessions');
    }
}
