<?php

namespace App\Models;

use App\Models\PatientHistory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';

    protected $fillable = [
        'patient_id',
        'patient_hrn',
        'date_visit',
        'type_visit',
        'admission_date',
        'discharge_date',
        'refered_by',
        'total_no_day',
        'admitting_physician',
        'admitting_clerk',
        'soc_serv_classification',
        'allergic_to',
        'hospitalization_plan',
        'health_insurance_name',
        'phic',
        'address_of_informant',
        'relation_to_patient',
        'admission_diagnosis',
        'discharge_diagnosis',
        'icd10_code',
        'disposition',
        'soap_subj_symptoms',
        'soap_obj_findings',
        'soap_assessment',
        'soap_plan',
        'vital_bp',
        'vital_hr',
        'vital_temp',
        'vital_height',
        'vital_weight',
        'vital_bmi',
        'is_approved',
        'health_monitor',

        // ipd clinical record
        'cr_symptoms',
        'cr_chief_complain',
        'cr_history_present_ill',
        'cr_ob_history',
        'cr_past_med_history',
        'cr_personal_soc_history',
        'cr_family_history',
        'cr_general_survey',
        'cr_heent',
        'cr_chest_lungs',
        'cr_cvs',
        'cr_abdomen',
        'cr_gu_ie',
        'cr_skin_extremities',
        'cr_neurological_exam',

        'case_number',
        'bed_id',
        'kin_to_notif',
        'kintonotif_relationship',
        'kintonotif_address',
        'kintonotif_contact_no',
        'data_furnished_by',
        'dfby_relation_to_patient',
        'dfby_address',
        'dfby_contact_no',
        'date_surgery',
        'principal_opt_code',
        'principal_opt_desc',
        'other_opt_code',
        'other_opt_desc',
        'accident_injury_poison',
        'icd10_code',
        'icd10_desc',
        'rvs_code',
        'allegic_to',
        'name_surgeon',
        'type_of_anesthesia',
        'principal_diagnosis',
        'other_diagnosis',
        'name_physician'
    ];

    protected $casts = [
        'cr_symptoms' => 'array',
        'cr_heent' => 'array',
        'cr_chest_lungs' => 'array',
        'cr_cvs' => 'array',
        'cr_abdomen' => 'array',
        'cr_gu_ie' => 'array',
        'cr_skin_extremities' => 'array',
        'cr_neurological_exam' => 'array',
    ];

    const NEW_OPD = 'new_opd'; // newly created patient on opd

    const REVISIT_OPD = 'revisit_opd'; // already exists patient on opd

    const FORMER_OPD = 'former_opd'; // already exists patient on opd move to ipd (once)

    const NEW_IPD = 'new_ipd'; // newly create patient on ipd

    const REVISIT_IPD = 'revisit_ipd'; // already exists patient on ipd

    const NEW_ER = 'new_er'; // newly created patient on er

    public function user_data_info() {
        return $this->hasOne(PersonalInformation::class, 'personal_id', 'patient_id');
    }

    public function physician_data_info() {
        return $this->hasOne(PersonalInformation::class, 'personal_id', 'admitting_physician');
    }

    public function doctor_orders()
    {
        return $this->hasMany(DoctorOrder::class, 'patient_id', 'patient_id');
    }

    public function health_monitors()
    {
        return $this->hasMany(HealthMonitor::class, 'patient_id', 'patient_id');
    }

    public function clerk_data_info() {
        return $this->hasOne(PersonalInformation::class, 'personal_id', 'admitting_clerk');
    }

    public function order_lists()
    {
        return $this->hasMany(OrderList::class, 'patient_id', 'patient_id');
    }

    public function progress_notes()
    {
        return $this->hasMany(ProgressNotes::class, 'patient_id', 'patient_id');
    }
    public function patient_history() {
        return $this->hasMany(PatientHistory::class, 'user_id', 'patient_id');
    }

    public function getUserFullNameAttribute() {
        return $this->user_data_info->last_name .' '.$this->user_data_info->first_name;
    }

    public function getPhysicianFullNameAttribute() {
        return 'Dr '.$this->physician_data_info->last_name .' '.$this->physician_data_info->first_name;
    }

    public function getClerkFullNameAttribute() {
        return $this->clerk_data_info->last_name .' '.$this->clerk_data_info->first_name;
    }

    public function scopeDetailInformation($query) {
        $query->with(['user_data_info', 'physician_data_info', 'clerk_data_info', 'patient_history', 'doctor_orders', 'doctor_orders.order_lists', 'doctor_orders.progress_notes', 'health_monitors']);
    }

    public function scopeDetailInformationById($query, $request) {
        $query->with(['user_data_info', 'physician_data_info', 'clerk_data_info', 'doctor_orders', 'doctor_orders.order_lists', 'doctor_orders.progress_notes', 'health_monitors'])->where('patient_id', $request->user_id);
    }
}