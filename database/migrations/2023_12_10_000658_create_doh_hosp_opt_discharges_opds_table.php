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
        Schema::create('doh_hosp_opt_discharges_opds', function (Blueprint $table) {
            $table->id();
            $table->text('opd_consultations')->nullable();
            $table->integer('number')->nullable();
            $table->string('icd10_code')->nullable();
            $table->string('icd10_cat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doh_hosp_opt_discharges_opds');
    }
};
