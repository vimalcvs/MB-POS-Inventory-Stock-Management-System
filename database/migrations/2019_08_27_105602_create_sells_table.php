<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sells', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_id');
            $table->integer('customer_id');
            $table->integer('branch_id');
            $table->integer('created_by');
            $table->double('sub_total');
            $table->double('discount')->default(0);
            $table->double('grand_total_price');
            $table->double('paid_amount');
            $table->double('due_amount');
            $table->date('sell_date');
            $table->tinyInteger('payment_type')->default(1);
            $table->text('card_information')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sells');
    }
}
