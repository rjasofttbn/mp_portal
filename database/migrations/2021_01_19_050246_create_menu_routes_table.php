<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_routes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('name_bn');
            $table->integer('menu_id');
            $table->string('section_or_route')->nullable();
            $table->integer('sort');
            $table->string('route');
            $table->integer('status')->length(1)->default(1);
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
        Schema::dropIfExists('menu_routes');
    }
}
