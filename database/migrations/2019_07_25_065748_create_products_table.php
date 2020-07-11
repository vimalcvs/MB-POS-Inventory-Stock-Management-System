<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('sku')->unique();
            $table->integer('category_id');
            $table->integer('branch_id');
            $table->integer('tax_id');
            $table->integer('price_type')->default(1);
            $table->double('purchase_price');
            $table->double('sell_price');
            $table->string('short_description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->integer('quantity')->default(0);
            $table->double('total_price')->default(0);
            $table->double('tax_percentage')->default(0);
            $table->double('tax_amount')->default(0);
            $table->string('created_by');
            $table->boolean('status')->default(1)->comment('1=Active,2=InActive');
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
        Schema::dropIfExists('products');
    }
}
