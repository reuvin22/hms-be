<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DohHospRevenue extends Model
{
    use HasFactory;

    protected $table = 'doh_hospital_revenues';

    protected $fillable = [
        'amount_fromdoh',
        'amount_fromlgu',
        'amount_fromdonor',
        'amount_fromprivorg',
        'amount_from_phealth',
        'amount_from_patient',
        'amount_from_reimbursement',
        'amount_from_othersources',
        'grand_total',	
    ];

    public function getModelAttributes() {
        return [
            'amount_fromdoh' => $this->amount_fromdoh,
            'amount_fromlgu' => $this->amount_fromlgu,
            'amount_fromdonor' => $this->amount_fromdonor,
            'amount_fromprivorg' => $this->amount_fromprivorg,
            'amount_from_phealth' => $this->amount_from_phealth,
            'amount_from_patient' => $this->amount_from_patient,
            'amount_from_reimbursement' => $this->amount_from_reimbursement,
            'amount_from_othersources' => $this->amount_from_othersources,
            'grand_total' => $this->grand_total
        ];
    }
}
