<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelephoneExpenseCashAllowancePabxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telephone_expense_cash_allowance_pabxes', function (Blueprint $table) {
            $table->id();
            $table->string('designition_id');
            $table->double('telphone_expenses');
            $table->double('cashing_allowance');
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('telephone_expense_cash_allowance_pabxes');
    }
}
