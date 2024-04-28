<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DohHospOptDschrgsEv extends Model
{
    use HasFactory;
    
    protected $table = 'doh_hosp_discharges_ev';

    protected $fillable = [
        'er_visit',
        'er_visits_adult',
        'er_visits_pediatric',
        'ev_from_facil_to_another',
        'ev_to_facil_to_another',
    ];

    public function getModelAttributes() {
        return [
            'er_visit' => $this->er_visit,
            'er_visits_adult' => $this->er_visits_adult,
            'er_visits_pediatric' => $this->er_visits_pediatric,
            'ev_from_facil_to_another' => $this->ev_from_facil_to_another,
            'ev_to_facil_to_another' => $this->ev_to_facil_to_another,
        ];
    }
}
