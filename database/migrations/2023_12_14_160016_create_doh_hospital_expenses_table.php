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
        Schema::create('doh_hospital_expenses', function (Blueprint $table) {
            $table->id();		
            $table->decimal('salaries_wages', 10, 2)->nullable();
            $table->decimal('employee_benebits',10, 2)->nullable();
            $table->decimal('allowances',10, 2)->nullable();
            $table->decimal('total_ps',10, 2)->nullable();
            $table->decimal('total_amount_medicine',10, 2)->nullable();
            $table->decimal('total_amount_medical_supp',10, 2)->nullable();
            $table->decimal('total_amount_util',10, 2)->nullable();
            $table->decimal('total_amount_nonmedserv',10, 2)->nullable();
            $table->decimal('total_mooe',10, 2)->nullable();
            $table->decimal('amount_infras',10, 2)->nullable();
            $table->decimal('amount_equip',10, 2)->nullable();
            $table->decimal('total_co',10, 2)->nullable();
            $table->decimal('grand_total',10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doh_hospital_expenses');
    }
};
