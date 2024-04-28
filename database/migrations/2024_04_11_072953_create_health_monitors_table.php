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
        //.
        Schema::create('health_monitors', function (Blueprint $table) {
            $table->id();
            $table->integer('health_monitor_id');
            $table->string('patient_id');
            $table->string('date');
            $table->string('hour');
            $table->decimal('respiratory_rate', 5,2);
            $table->decimal('pulse_rate', 5,2);
            $table->decimal('temperature', 5,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_monitors');
    }
};