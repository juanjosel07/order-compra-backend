<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('order_id')->unsigned();
			$table->bigInteger('product_id')->unsigned();
			$table->integer('quantity');
			$table->decimal('unit_price',10,2);
			$table->decimal('iva',5,2);
			$table->decimal('subtotal',10,2);
			$table->decimal('total',10,2);
            $table->timestamps();
			$table->softDeletes();

			$table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
			$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
