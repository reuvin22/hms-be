<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DohHospOptSummaryPatient extends Model
{
    use HasFactory;
    
    protected $table = 'doh_hosp_opt_summary_patients';

    protected $fillable = [
        'total_number_inpatient',
        'total_newborn',
        'total_discharge',
        'total_pad',
        'total_ibd',
        'total_inpatient_transto',
        'total_inpatient_transfrom',
        'total_patients_remaining'
    ];

    public function getModelAttributes() {
        return [
            'total_number_inpatient' => $this->total_number_inpatient,
            'total_newborn' => $this->total_newborn,
            'total_discharge' => $this->total_discharge,
            'total_pad' => $this->total_pad,
            'total_ibd' => $this->total_ibd,
            'total_inpatient_transto' => $this->total_inpatient_transto,
            'total_inpatient_transfrom' => $this->total_inpatient_transfrom,
            'total_patients_remaining' => $this->total_patients_remaining
        ];
    }
}
