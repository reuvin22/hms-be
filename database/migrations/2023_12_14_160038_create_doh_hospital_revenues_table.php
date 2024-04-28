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
        Schema::create('doh_hospital_revenues', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount_fromdoh',10, 2)->nullable();
            $table->decimal('amount_fromlgu',10, 2)->nullable();
            $table->decimal('amount_fromdonor',10, 2)->nullable();
            $table->decimal('amount_fromprivorg',10, 2)->nullable();
            $table->decimal('amount_from_phealth',10, 2)->nullable();
            $table->decimal('amount_from_patient',10, 2)->nullable();
            $table->decimal('amount_from_reimbursement',10, 2)->nullable();
            $table->decimal('amount_from_othersources',10, 2)->nullable();
            $table->decimal('grand_total',10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doh_hospital_revenues');
    }
};
