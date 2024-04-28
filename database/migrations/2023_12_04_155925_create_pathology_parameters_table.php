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
        Schema::create('pathology_parameters', function (Blueprint $table) {
            $table->id();
            $table->string('param_name', 100);
            $table->string('test_value', 100)->nullable();
            $table->string('ref_range');
            $table->string('unit', 100);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pathology_parameters');
    }
};
