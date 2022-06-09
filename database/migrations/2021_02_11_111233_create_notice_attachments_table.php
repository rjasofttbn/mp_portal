<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticeAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notice_attachments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('attachment_type')->nullable()->default(1)->comment('1=notice attachment, 2=speech made by department');
            $table->unsignedBigInteger('notice_id');
            $table->string('attachment');
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
            $table->foreign('notice_id')->references('id')->on('notices');
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
        Schema::dropIfExists('notice_attachments');
    }
}
