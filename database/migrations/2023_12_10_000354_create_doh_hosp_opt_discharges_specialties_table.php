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
        Schema::create('doh_hosp_opt_discharges_specialties', function (Blueprint $table) {
            $table->id();
            $table->integer('type_of_service_id')->nullable();
            $table->integer('no_patients')->nullable();
            $table->integer('total_length_stay')->nullable();
            $table->integer('np_pay')->nullable();
            $table->integer('nph_service_charity')->nullable();
            $table->integer('nph_total')->nullable();
            $table->integer('ph_pay')->nullable();
            $table->integer('ph_service')->nullable();
            $table->integer('ph_total')->nullable();
            $table->integer('hmo')->nullable();
            $table->integer('owwa')->nullable();
            $table->integer('recovered_improved')->nullable();
            $table->integer('transferred')->nullable();
            $table->integer('hama')->nullable();
            $table->integer('absconded')->nullable();
            $table->integer('unimproved')->nullable();
            $table->integer('deaths_below48')->nullable();
            $table->integer('deaths_over48')->nullable();
            $table->integer('total_deaths')->nullable();
            $table->integer('total_discharges')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doh_hosp_opt_discharges_specialties');
    }
};
