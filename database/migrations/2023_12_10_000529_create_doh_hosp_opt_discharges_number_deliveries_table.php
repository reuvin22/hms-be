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
        Schema::create('doh_hosp_opt_discharges_number_deliveries', function (Blueprint $table) {
            $table->id();
            $table->integer('total_ifdelivery')->nullable();
            $table->integer('total_lbvdelivery')->nullable();
            $table->integer('total_lbcdelivery')->nullable();
            $table->integer('total_otherdelivery')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doh_hosp_opt_discharges_number_deliveries');
    }
};
