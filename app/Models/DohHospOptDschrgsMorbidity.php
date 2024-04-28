<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DohHospOptDschrgsMorbidity extends Model
{
    use HasFactory;
    
    protected $table = 'doh_hosp_opt_discharges_morbidities';

    protected $fillable = [
        'icd10_desc',
        'm_under1',
        'f_under1',
        'm_1to4',
        'f_1to4',
        'm_5to9',
        'f_5to9',
        'm_10to14',
        'f_10to14',
        'm_15to19',
        'f_15to19',
        'm_20to24',
        'f_20to24',
        'm_25to29',
        'f_25to29',
        'm_30to34',
        'f_30to34',
        'm_35to39',
        'f_35to39',
        'm_40to44',
        'f_40to44',
        'm_45to49',
        'f_45to49',
        'm_50to54',
        'f_50to54',
        'm_55to59',
        'f_55to59',
        'm_60to64',
        'f_60to64',
        'm_65to69',
        'f_65to69',
        'm_70over',
        'f_70over',
        'm_sub_total',
        'f_sub_total',
        'grand_total',
        'icd10_code',
        'icd10_cat'
    ];

    public function getModelAttributes() {
        return [
            'icd10_desc' => $this->icd10_desc,
            'm_under1' => $this->m_under1,
            'f_under1' => $this->f_under1,
            'm_1to4' => $this->m_1to4,
            'f_1to4' => $this->f_1to4,
            'm_5to9' => $this->m_5to9,
            'f_5to9' => $this->f_5to9,
            'm_10to14' => $this->m_10to14,
            'f_10to14' => $this->f_10to14,
            'm_15to19' => $this->m_15to19,
            'f_15to19' => $this->f_15to19,
            'm_20to24' => $this->m_20to24,
            'f_20to24' => $this->f_20to24,
            'm_25to29' => $this->m_25to29,
            'f_25to29' => $this->f_25to29,
            'm_30to34' => $this->m_30to34,
            'f_30to34' => $this->f_30to34,
            'm_35to39' => $this->m_35to39,
            'f_35to39' => $this->f_35to39,
            'm_40to44' => $this->m_40to44,
            'f_40to44' => $this->f_40to44,
            'm_45to49' => $this->m_45to49,
            'f_45to49' => $this->f_45to49,
            'm_50to54' => $this->m_50to54,
            'f_50to54' => $this->f_50to54,
            'm_55to59' => $this->m_55to59,
            'f_55to59' => $this->f_55to59,
            'm_60to64' => $this->m_60to64,
            'f_60to64' => $this->f_60to64,
            'm_65to69' => $this->m_65to69,
            'f_65to69' => $this->f_65to69,
            'm_70over' => $this->m_70over,
            'f_70over' => $this->f_70over,
            'm_sub_total' => $this->m_sub_total,
            'f_sub_total' => $this->f_sub_total,
            'grand_total' => $this->grand_total,
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
