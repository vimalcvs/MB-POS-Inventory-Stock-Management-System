<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDraftProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('draft_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('draft_id');
            $table->integer('product_id');
            $table->double('purchase_price');
            $table->double('sell_price');
            $table->double('tax_percentage');
            $table->double('tax_amount');
            $table->double('quantity');
            $table->double('total_price');
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
        Schema::dropIfExists('draft_products');
    }
}
