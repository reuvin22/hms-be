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
        Schema::create('patient_billings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('patient_id', 15);
            $table->string('physician_id', 15);
            $table->integer('physician_charge');
            $table->integer('hospital_charge')->nullable();
            $table->integer('other_charge')->nullable();
            $table->integer('discount')->nullable();
            $table->decimal('tax', 10, 2)->nullable();
            $table->decimal('gross_total', 10, 2)->nullable();
            $table->decimal('net_amount', 10, 2)->nullable();
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_billings');
    }
};
