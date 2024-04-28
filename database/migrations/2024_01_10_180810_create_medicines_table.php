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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->integer('purchase_price')->nullable();
            $table->date('duration_from');
            $table->date('duration_to');
            $table->integer('amount');
            $table->string('brand_name', 20);
            $table->string('generic_name', 20);
            $table->string('dosage', 20);
            $table->decimal('vat', 10, 2)->nullable();
            $table->boolean('is_active')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
