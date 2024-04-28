<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DohHospExpenses extends Model
{
    use HasFactory;

    protected $table = 'doh_hospital_expenses';
    
    protected $fillable = [
        'salaries_wages',
        'employee_benebits',
        'allowances',
        'total_ps',
        'total_amount_medicine',
        'total_amount_medical_supp',
        'total_amount_util',
        'total_amount_nonmedserv',
        'total_mooe',	
        'amount_infras',
        'amount_equip',
        'total_co',
        'grand_total',
    ];

    public function getModelAttributes() {
        return [
            'salaries_wages' => $this->salaries_wages,
            'employee_benebits' => $this->employee_benebits,
            'allowances' => $this->allowances,
            'total_ps' => $this->total_ps,
            'total_amount_medicine' => $this->total_amount_medicine,
            'total_amount_medical_supp' => $this->total_amount_medical_supp,
            'total_amount_util' => $this->total_amount_util,
            'total_amount_nonmedserv' => $this->total_amount_nonmedserv,
            'total_mooe' => $this->total_mooe,
            'amount_infras' => $this->amount_infras,
            'amount_equip' => $this->amount_equip,
            'total_co' => $this->total_co,
            'grand_total' => $this->grand_total,
        ];
    }
}
