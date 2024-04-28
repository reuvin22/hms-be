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
        Schema::create('doh_hosp_opt_mortality_deaths', function (Blueprint $table) {
            $table->id();
            $table->text('icd10_desc')->nullable();
            $table->integer('m_under1')->nullable();
            $table->integer('f_under1')->nullable();
            $table->integer('m_1to4')->nullable();
            $table->integer('f_1to4')->nullable();
            $table->integer('m_5to9')->nullable();
            $table->integer('f_5to9')->nullable();
            $table->integer('m_10to14')->nullable();
            $table->integer('f_10to14')->nullable();
            $table->integer('m_15to19')->nullable();
            $table->integer('f_15to19')->nullable();
            $table->integer('m_20to24')->nullable();
            $table->integer('f_20to24')->nullable();
            $table->integer('m_25to29')->nullable();
            $table->integer('f_25to29')->nullable();
            $table->integer('m_30to34')->nullable();
            $table->integer('f_30to34')->nullable();
            $table->integer('m_35to39')->nullable();
            $table->integer('f_35to39')->nullable();
            $table->integer('m_40to44')->nullable();
            $table->integer('f_40to44')->nullable();
            $table->integer('m_45to49')->nullable();
            $table->integer('f_45to49')->nullable();
            $table->integer('m_50to54')->nullable();
            $table->integer('f_50to54')->nullable();
            $table->integer('m_55to59')->nullable();
            $table->integer('f_55to59')->nullable();
            $table->integer('m_60to64')->nullable();
            $table->integer('f_60to64')->nullable();
            $table->integer('m_65to69')->nullable();
            $table->integer('f_65to69')->nullable();
            $table->integer('m_70over')->nullable();
            $table->integer('f_70over')->nullable();
            $table->integer('m_sub_total')->nullable();
            $table->integer('f_sub_total')->nullable();
            $table->integer('grand_total')->nullable();
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
        Schema::dropIfExists('doh_hosp_opt_mortality_deaths');
    }
};
