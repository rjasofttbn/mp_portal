<?php

/*
  Author : Rajan Bhatta
 Created date: 28-01-2021
*/

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParliamentRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parliament_rules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rule_number');
            $table->string('name');
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(1)->comment("0= Inactive, 1= Active");

            $table->bigInteger('department_id')->unsigned();
            $table->foreign('department_id')->references('id')->on('departments');

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
        Schema::dropIfExists('parliament_rules');
    }
}
