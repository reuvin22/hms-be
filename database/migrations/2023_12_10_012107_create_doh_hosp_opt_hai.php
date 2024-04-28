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
        Schema::create('doh_hosp_opt_hai', function (Blueprint $table) {
            $table->id();
            $table->decimal('num_hai', 5, 4)->nullable();
            $table->decimal('num_discharges', 5, 4)->nullable();
            $table->decimal('infection_rate', 5, 4)->nullable();
            $table->decimal('patient_num_vap', 5, 4)->nullable();
            $table->decimal('total_ventilator_days', 5, 4)->nullable();
            $table->decimal('result_vap', 5, 4)->nullable();
            $table->decimal('patient_num_bsi', 5, 4)->nullable();
            $table->decimal('total_num_centralline', 5, 4)->nullable();
            $table->decimal('result_bsi', 5, 4)->nullable();
            $table->decimal('patient_num_uti', 5, 4)->nullable();
            $table->decimal('total_catheter_days', 5, 4)->nullable();
            $table->decimal('result_uti', 5, 4)->nullable();
            $table->decimal('num_ssi', 5, 4)->nullable();
            $table->decimal('total_procedures_done', 5, 4)->nullable();
            $table->decimal('result_ssi', 5, 4)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doh_hosp_opt_hai');
    }
};
