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
        Schema::create('pathologies', function (Blueprint $table) {
            $table->id();
            $table->string('test_name');
            $table->string('short_name', 50);
            $table->integer('patho_category_id');
            $table->integer('patho_param_id')->nullable();
            $table->string('unit',50)->nullable();
            $table->string('sub_category',50)->nullable();
            $table->string('report_days',50)->nullable();
            $table->string('methods',50)->nullable();
            $table->integer('charge')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pathologies');
    }
};
