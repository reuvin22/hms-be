<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DohHospOptDschrgsOpv extends Model
{
    use HasFactory;
    
    protected $table = 'doh_hosp_opt_discharges_opvs';

    protected $fillable = [
        'new_patient',	
        're_visit',	
        'adult',	
        'pediatric',
        'adult_general_medicine',	
        'specialty_non_surgical',
        'surgical',	
        'antenatal',	
        'postnatal'
    ];

    public function getModelAttributes() {
        return [
            'new_patient' => $this->new_patient,	
            're_visit' => $this->re_visit,	
            'adult' => $this->adult,	
            'pediatric' => $this->pediatric,
            'adult_general_medicine' => $this->adult_general_medicine,	
            'specialty_non_surgical' => $this->specialty_non_surgical,
            'surgical' => $this->surgical,	
            'antenatal' => $this->antenatal,	
            'postnatal' => $this->postnatal
        ];
    }
}
