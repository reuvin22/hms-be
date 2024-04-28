<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DohHospOptDschrgsSpecialty extends Model
{
    use HasFactory;
    
    protected $table = 'doh_hosp_opt_discharges_specialties';

    protected $fillable = [
        'type_of_service_id',
        'no_patients',
        'total_length_stay',	
        'np_pay',
        'nph_service_charity',	
        'nph_total',	
        'ph_pay',	
        'ph_service',	
        'ph_total',	
        'hmo',	
        'owwa',	
        'recovered_improved',	
        'transferred',	
        'hama',	
        'absconded',	
        'unimproved',	
        'deaths_below48',	
        'deaths_over48',	
        'total_deaths',	
        'total_discharges',	
        'remarks'
    ];

    public function getModelAttributes() {
        return [
            'type_of_service_id' => $this->type_of_service_id,
            'no_patients' => $this->no_patients,
            'total_length_stay' => $this->total_length_stay,	
            'np_pay' => $this->np_pay,
            'nph_service_charity' => $this->nph_service_charity,	
            'nph_total' => $this->nph_total,	
            'ph_pay' => $this->ph_pay,	
            'ph_service' => $this->ph_service,	
            'ph_total' => $this->ph_total,	
            'hmo' => $this->hmo,	
            'owwa' => $this->owwa,	
            'recovered_improved' => $this->recovered_improved,	
            'transferred' => $this->transferred,	
            'hama' => $this->hama,	
            'absconded' => $this->absconded,	
            'unimproved' => $this->unimproved,	
            'deaths_below48' => $this->deaths_below48,	
            'deaths_over48' => $this->deaths_over48,	
            'total_deaths' => $this->total_deaths,	
            'total_discharges' => $this->total_discharges,	
            'remarks' => $this->remarks
        ];
    }

    public function specialty_service() {
        return $this->hasOne(DohSpecialtyService::class, 'id', 'type_of_service_id');
    }

    public function scopeHasSs($query) {
        return $query->with(['specialty_service']);
    }
}
