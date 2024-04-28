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
        Schema::create('inventory_item_stock_lists', function (Blueprint $table) {
            $table->id();
            $table->string('item', 50);
            $table->integer('category_id');
            $table->string('supplier', 150);
            $table->date('date');
            $table->integer('qty');
            $table->string('purchase_price', 7);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_item_stock_lists');
    }
};
