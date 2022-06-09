<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParliamentBillSubClausesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parliament_bill_sub_clauses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parliament_bill_id');
            $table->unsignedBigInteger('parliament_bill_clause_id');
            $table->integer('number');
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
        Schema::dropIfExists('parliament_bill_sub_clauses');
    }
}
