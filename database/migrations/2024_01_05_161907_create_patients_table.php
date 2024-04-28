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
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('patient_id', 15);
            $table->string('patient_hrn')->nullable();
            $table->dateTime('date_visit')->nullable();
            $table->string('type_visit', 50)->nullable();
            $table->string('admission_date')->nullable();
            $table->string('discharge_date')->nullable();
            $table->string('refered_by')->nullable();
            $table->integer('total_no_day')->nullable();
            $table->string('admitting_physician', 15);
            $table->string('admitting_clerk', 15);
            $table->string('soc_serv_classification',5)->nullable();
            $table->string('allergic_to')->nullable();
            $table->string('hospitalization_plan')->nullable();
            $table->string('health_insurance_name')->nullable();
            $table->string('phic')->nullable();
            $table->string('address_of_informant')->nullable();
            $table->string('relation_to_patient')->nullable();
            $table->text('admission_diagnosis')->nullable();
            $table->text('discharge_diagnosis')->nullable();
            $table->string('icd10_code', 20)->nullable();
            $table->string('icd10_desc')->nullable();
            $table->string('accident_injury_poison')->nullable();
            $table->string('disposition', 100)->nullable();
            $table->text('soap_subj_symptoms')->nullable();
            $table->text('soap_obj_findings')->nullable();
            $table->text('soap_assessment')->nullable();
            $table->text('soap_plan')->nullable();
            $table->string('vital_bp',20)->nullable();
            $table->string('vital_hr',20)->nullable();
            $table->string('vital_temp',20)->nullable();
            $table->string('vital_o2sat',20)->nullable();
            $table->string('vital_height',20)->nullable();
            $table->string('vital_weight',20)->nullable();
            $table->string('vital_bmi',20)->nullable();
            $table->string('is_approved', 20)->default("Pending");
            // ipd clinical record
            $table->string('cr_chief_complain')->nullable();
            $table->string('cr_history_present_ill')->nullable();
            $table->string('cr_ob_history')->nullable();
            $table->string('cr_past_med_history')->nullable();
            $table->string('cr_personal_soc_history')->nullable();
            $table->string('cr_family_history')->nullable();
            $table->string('cr_general_survey')->nullable();
            $table->text('cr_heent')->nullable();
            $table->text('cr_chest_lungs')->nullable();
            $table->text('cr_cvs')->nullable();
            $table->text('cr_abdomen')->nullable();
            $table->text('cr_gu_ie')->nullable();
            $table->text('cr_skin_extremities')->nullable();
            $table->text('cr_neurological_exam')->nullable();
            $table->text('cr_symptoms')->nullable();


            $table->string('case_number')->nullable();
            $table->string('bed_id')->nullable();
            $table->string('kin_to_notif')->nullable();
            $table->string('kintonotif_relationship')->nullable();
            $table->string('kintonotif_address')->nullable();
            $table->string('kintonotif_contact_no')->nullable();
            $table->string('data_furnished_by')->nullable();
            $table->string('dfby_relation_to_patient')->nullable();
            $table->string('dfby_address')->nullable();
            $table->string('dfby_contact_no')->nullable();
            $table->dateTime('date_surgery')->nullable();
            $table->string('principal_opt_code')->nullable();
            $table->string('principal_opt_desc')->nullable();
            $table->string('other_opt_code')->nullable();
            $table->string('other_opt_desc')->nullable();
            $table->string('rvs_code')->nullable();
            $table->string('allegic_to')->nullable();
            $table->string('name_surgeon', 15)->nullable();
            $table->string('type_of_anesthesia')->nullable();
            $table->text('principal_diagnosis')->nullable();
            $table->text('other_diagnosis')->nullable();
            $table->string('name_physician', 15)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
