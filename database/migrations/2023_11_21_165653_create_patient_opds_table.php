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
        Schema::create('patient_opds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('patient_id', 15);
            $table->string('patient_hrn');
            $table->dateTime('date_visit');
            $table->string('type_visit', 50);
            $table->dateTime('admission_date')->nullable();
            $table->dateTime('discharge_date')->nullable();
            $table->string('refered_by')->nullable();
            $table->integer('total_no_day')->nullable();
            $table->string('admitting_physician', 15);
            $table->string('admitting_clerk', 15);
            $table->string('soc_serv_classification',5)->nullable();
            $table->string('allergic_to')->nullable();
            $table->string('hospitalization_plan')->nullable();
            $table->string('health_insurance_name')->nullable();
            $table->string('phic')->nullable();
            $table->string('data_furnished_by')->nullable();
            $table->string('address_of_informant')->nullable();
            $table->string('relation_to_patient')->nullable();
            $table->text('admission_diagnosis')->nullable();
            $table->text('discharge_diagnosis')->nullable();
            $table->string('icd10_code', 20)->nullable();
            $table->string('principal_opt_proc')->nullable();
            $table->string('other_opt_proc')->nullable();
            $table->string('accident_injury_poison')->nullable();
            $table->string('disposition', 100)->nullable();
            $table->text('soap_subj_symptoms')->nullable();
            $table->text('soap_obj_findings')->nullable();
            $table->text('soap_assessment')->nullable();
            $table->text('soap_plan')->nullable();
            $table->integer('vital_bp')->nullable();
            $table->integer('vital_hr')->nullable();
            $table->integer('vital_temp')->nullable();
            $table->integer('vital_height')->nullable();
            $table->integer('vital_weight')->nullable();
            $table->integer('vital_bmi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_opds');
    }
};
