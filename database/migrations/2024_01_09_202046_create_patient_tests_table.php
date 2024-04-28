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
        Schema::create('patient_tests', function (Blueprint $table) {
            $table->id();
            $table->string('patient_id', 15);
            $table->string('physician_id', 15);
            $table->integer('test_id');
            $table->integer('pathology_cat_id')->nullable();
            $table->string('lab_category', 20)->nullable();
            $table->string('status', 20)->nullable();
            $table->integer('charge')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_tests');
    }
};
