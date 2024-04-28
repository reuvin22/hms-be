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
        Schema::create('patient_ipds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('patient_id', 15);
            $table->string('case_number');
            $table->string('patient_hrn');
            $table->dateTime('date_visit');
            $table->string('type_visit', 50);
            $table->string('bed_id');
            $table->dateTime('admission_date');
            $table->dateTime('discharge_date');
            $table->integer('total_no_day');
            $table->string('kin_to_notif');
            $table->string('kintonotif_relationship');
            $table->string('kintonotif_address');
            $table->string('kintonotif_contact_no');
            $table->string('data_furnished_by', 15);
            $table->string('dfby_relation_to_patient');
            $table->string('dfby_address');
            $table->string('dfby_contact_no');
            $table->string('admitting_physician', 15);
            $table->string('admitting_clerk', 15);
            $table->string('referred_by');
            $table->string('soc_serv_classification', 5);
            $table->string('hospitalization_plan');
            $table->string('health_insurance_name');
            $table->string('phic', 20);
            $table->text('admission_diagnosis');
            $table->dateTime('date_surgery');
            $table->string('principal_opt_proc_code');
            $table->string('other_opt_proc_code');
            $table->string('rvs_code');
            $table->string('allegic_to');
            $table->string('name_surgeon', 15);
            $table->string('type_of_anesthesia');
            $table->string('accident_injury_poison');
            $table->text('discharge_diagnosis');
            $table->text('principal_diagnosis');
            $table->text('other_diagnosis');
            $table->string('icd10_code');
            $table->string('condition_discharge');
            $table->string('name_physician', 15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_ipds');
    }
};
