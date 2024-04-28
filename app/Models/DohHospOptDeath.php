<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DohHospOptDeath extends Model
{
    use HasFactory;
    
    protected $table = 'doh_hosp_opt_deaths';

    protected $fillable = [
        'total_deaths',	
        'total_deaths48down',	
        'total_deaths48up',	
        'total_erdeaths',	
        'total_doa',	
        'total_stillbirths',	
        'total_neonatal_deaths',	
        'total_maternal_deaths',
        'total_deaths_newborn',
        'total_discharge_deaths',
        'gross_deathrate',
        'ndr_numerator',
        'ndr_denominator',
        'net_deathrate'
    ];

    public function getModelAttributes() {
        return [
            'total_deaths' => $this->total_deaths,	
            'total_deaths48down'   => $this->total_deaths48down,	
            'total_deaths48up'   => $this->total_deaths48up,	
            'total_erdeaths'   => $this->total_erdeaths,	
            'total_doa'   => $this->total_doa,	
            'total_stillbirths'   => $this->total_stillbirths,	
            'total_neonatal_deaths'   => $this->total_neonatal_deaths,	
            'total_maternal_deaths'   => $this->total_maternal_deaths,
            'total_deaths_newborn'   => $this->total_deaths_newborn,
            'total_discharge_deaths'   => $this->total_discharge_deaths,
            'gross_deathrate'   => $this->gross_deathrate,
            'ndr_numerator'   => $this->ndr_numerator,
            'ndr_denominator'   => $this->ndr_denominator,
            'net_deathrate'   => $this->net_deathrate
        ];
    }
}
