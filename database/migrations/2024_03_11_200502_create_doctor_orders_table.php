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
        Schema::create('doctor_orders', function (Blueprint $table) {
            $table->id();
            $table->string('patient_id', 15)->nullable();
            $table->string('physician_id', 15)->nullable();
            $table->dateTime('date_time')->nullable();
            $table->string('progress_notes')->nullable();
            $table->string('physician_order', 10)->default('pending');
            $table->string('nurse_incharge', 15)->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_orders');
    }
};
