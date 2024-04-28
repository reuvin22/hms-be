<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientIPD extends Model
{
    use HasFactory;

    protected $table = 'patient_ipds';

    protected $fillable = [
        'patient_id',
        'case_number',
        'patient_hrn',
        'date_visit',
        'type_visit',
        'bed_id',
        'admission_date',
        'discharge_date',
        'total_no_day',
        'kin_to_notif',
        'kintonotif_relationship',
        'kintonotif_address',
        'kintonotif_contact_no',
        'data_furnished_by',
        'dfby_relation_to_patient',
        'dfby_address',
        'dfby_contact_no',
        'admitting_physician',
        'admitting_clerk',
        'referred_by',
        'soc_serv_classification',
        'hospitalization_plan',
        'health_insurance_name',
        'phic',
        'admission_diagnosis',
        'date_surgery',
        'principal_opt_proc_code',
        'other_opt_proc_code',
        'rvs_code',
        'allegic_to',
        'name_surgeon',
        'type_of_anesthesia',
        'accident_injury_poison',
        'discharge_diagnosis',
        'principal_diagnosis',
        'other_diagnosis',
        'icd10_code',
        'condition_discharge',
        'name_physician'
    ];

    public function patient_identity() {
        return $this->hasOne(Identity::class, 'user_id', 'patient_id');
    }

    public function physician_identity() {
        return $this->hasOne(Identity::class, 'user_id', 'admitting_physician');
    }

    public function clerk_identity() {
        return $this->hasOne(Identity::class, 'user_id', 'admitting_clerk');
    }

    public function surgeon_identity() {
        return $this->hasOne(Identity::class, 'user_id', 'name_surgeon');
    }

    public function scopeHasDetailInfo($query) {
        return $query->with(['patient_identity', 'physician_identity', 'clerk_identity', 'surgeon_identity']);
    }
}
