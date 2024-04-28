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
        Schema::create('doh_hosp_opt_summary_patients', function (Blueprint $table) {
            $table->id();
            $table->integer('total_number_inpatient')->nullable();
            $table->integer('total_newborn')->nullable();
            $table->integer('total_discharge')->nullable();
            $table->integer('total_pad')->nullable();
            $table->integer('total_ibd')->nullable();
            $table->integer('total_inpatient_transto')->nullable();
            $table->integer('total_inpatient_transfrom')->nullable();
            $table->integer('total_patients_remaining')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doh_hosp_opt_summary_patients');
    }
};
