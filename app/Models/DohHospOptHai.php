<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DohHospOptHai extends Model
{
    use HasFactory;
    
    protected $table = 'doh_hosp_opt_hai';

    protected $fillable = [
        'num_hai',	
        'num_discharges',	
        'infection_rate',	
        'patient_num_vap',
        'total_ventilator_days',
        'result_vap',
        'patient_num_bsi',	
        'total_num_centralline',	
        'result_bsi',
        'patient_num_uti',
        'total_catheter_days',	
        'result_uti',	
        'num_ssi',	
        'total_procedures_done',	
        'result_ssi'
    ];

    public function getModelAttributes() {
        return [
            'num_hai' => $this->num_hai,	
            'num_discharges' => $this->num_discharges,	
            'infection_rate' => $this->infection_rate,	
            'patient_num_vap' => $this->patient_num_vap,
            'total_ventilator_days' => $this->total_ventilator_days,
            'result_vap' => $this->result_vap,
            'patient_num_bsi' => $this->patient_num_bsi,	
            'total_num_centralline' => $this->total_num_centralline,	
            'result_bsi' => $this->result_bsi,
            'patient_num_uti' => $this->patient_num_uti,
            'total_catheter_days' => $this->total_catheter_days,	
            'result_uti' => $this->result_uti,	
            'num_ssi' => $this->num_ssi,	
            'total_procedures_done' => $this->total_procedures_done,	
            'result_ssi' => $this->result_ssi
        ];
    }
}
