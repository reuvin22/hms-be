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
        Schema::create('patient_lab_results', function (Blueprint $table) {
            $table->id();
            $table->string('patient_id', 15);
            $table->string('physician_id', 15);
            $table->string('test_name');
            $table->string('result')->nullable();
            $table->string('normal_range')->nullable();
            $table->string('units')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_lab_results');
    }
};
