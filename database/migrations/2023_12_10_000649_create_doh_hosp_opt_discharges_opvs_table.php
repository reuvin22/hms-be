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
        Schema::create('doh_hosp_opt_discharges_opvs', function (Blueprint $table) {
            $table->id();
            $table->integer('new_patient')->nullable();
            $table->integer('re_visit')->nullable();
            $table->integer('adult')->nullable();
            $table->integer('pediatric')->nullable();
            $table->integer('adult_general_medicine')->nullable();
            $table->integer('specialty_non_surgical')->nullable();
            $table->integer('surgical')->nullable();
            $table->integer('antenatal')->nullable();
            $table->integer('postnatal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doh_hosp_opt_discharges_opvs');
    }
};
