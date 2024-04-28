<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DohHospOptDschrgsNumDeliv extends Model
{
    use HasFactory;
    
    protected $table = 'doh_hosp_opt_discharges_number_deliveries';

    protected $fillable = [
        'total_ifdelivery',	
        'toal_lbvdelivery',	
        'total_lbcdelivery',	
        'total_otherdelivery'
    ];

    public function getModelAttributes() {
        return [
            'total_ifdelivery' => $this->total_ifdelivery,	
            'toal_lbvdelivery' => $this->toal_lbvdelivery,	
            'total_lbcdelivery' => $this->total_lbcdelivery,	
            'total_otherdelivery' => $this->total_otherdelivery
        ];
    }
}
