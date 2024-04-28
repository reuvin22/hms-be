<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DohHospOptDschrgsOpd extends Model
{
    use HasFactory;
    
    protected $table = 'doh_hosp_opt_discharges_opds';

    protected $fillable = [
        'opd_consultations',	
        'number',	
        'icd10_code',	
        'icd10_cat'
    ];

    public function getModelAttributes() {
        return [
            'opd_consultations' => $this->opd_consultations,	
            'number' => $this->number,	
            'icd10_code' => $this->icd10_code,	
            'icd10_cat' => $this->icd10_cat
        ];
    }

    public function icd10() {
        return $this->hasOne(DohICD10::class, 'icd10_code', 'icd10_code');
    }

    public function scopeHasIcd10($query) {
        return $query->with(['icd10']);
    }
}
