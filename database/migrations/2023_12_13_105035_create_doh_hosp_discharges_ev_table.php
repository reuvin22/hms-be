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
        Schema::create('doh_hosp_discharges_ev', function (Blueprint $table) {
            $table->id();
            $table->integer('er_visit')->nullable();
            $table->integer('er_visits_adult')->nullable();
            $table->integer('er_visits_pediatric')->nullable();
            $table->integer('ev_from_facil_to_another')->nullable();
            $table->integer('ev_to_facil_to_another')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doh_hosp_discharges_ev');
    }
};
