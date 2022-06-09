<?php
/**
 * Author M. Atoar Rahman
 * Date: 31/01/2021
 * Time: 05:40 PM
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParliamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parliaments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('parliament_number')->unique();
            $table->date('date_from');
            $table->date('date_to');
            $table->tinyInteger('status')->default(1);
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('parliaments');
    }
}
