<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisitions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('requisition_id');
            $table->integer('requisition_from');
            $table->integer('requisition_to');
            $table->date('requisition_date');
            $table->date('complete_date')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0=Pending, 1=Send, 2=Received, 3=Canceled');
            $table->boolean('is_click')->default(false);
            $table->integer('created_by');
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
        Schema::dropIfExists('requisitions');
    }
}
