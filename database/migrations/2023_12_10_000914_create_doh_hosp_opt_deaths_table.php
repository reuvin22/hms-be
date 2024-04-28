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
        Schema::create('doh_hosp_opt_deaths', function (Blueprint $table) {
            $table->id();
            $table->integer('total_deaths')->nullable();
            $table->integer('total_deaths48down')->nullable();
            $table->integer('total_deaths48up')->nullable();
            $table->integer('total_erdeaths')->nullable();
            $table->integer('total_doa')->nullable();
            $table->integer('total_stillbirths')->nullable();
            $table->integer('total_neonatal_deaths')->nullable();
            $table->integer('total_maternal_deaths')->nullable();
            $table->integer('total_deaths_newborn')->nullable();
            $table->integer('total_discharge_deaths')->nullable();
            $table->decimal('gross_deathrate', 5, 4)->nullable();
            $table->integer('ndr_numerator')->nullable();
            $table->integer('ndr_denominator')->nullable();
            $table->decimal('net_deathrate', 5, 4)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doh_hosp_opt_deaths');
    }
};
