<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PatientOPD extends Model
{
    use HasFactory;

    protected $table = 'patient_opds';
    // public $timestamps = false;

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
        'so_serv_classification',
        'allergic_to',
        'hospitalization_plan',
        'health_insurance_name',
        'phic',
        'data_furnished_by',
        'address_of_informant',
        'relation_to_patient',
        'admission_diagnosis',
        'discharge_diagnosis',
        'icd10_code',
        'principal_opt_proc',
        'other_opt_proc',
        'accident_injury_poison',
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
        'vital_bmi'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function user_datainfo() {
        return $this->hasOne(PersonalInformation::class, 'personal_id', 'patient_id');
    }

    public function physician_datainfo() {
        return $this->hasOne(PersonalInformation::class, 'personal_id', 'admitting_physician');
    }

    public function patient_history() {
        return $this->hasMany(PatientHistory::class, 'patient_id', 'patient_id');
    }

    public function scopeDetailInformation($query) {
        return $query->with(['user_datainfo', 'physician_datainfo', 'patient_history']);
    }
}
