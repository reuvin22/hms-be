<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DohHospOptDschrgsTesting extends Model
{
    use HasFactory;
    
    protected $table = 'doh_hosp_opt_discharges_testings';

    protected $fillable = [
        'testing_group_id',	
        'testing_id',	
        'number'
    ];

    public function getModelAttributes() {
        return [
            'testing_group_id' => $this->testing_group_id,	
            'testing_id' => $this->testing_id,	
            'number' => $this->number
        ];
    }

    public function testing_groups() {
        return $this->belongsTo(DohTestingGroup::class, 'id', 'testing_group_id');
    }

    public function testing() {
        return $this->belongsTo(DohTesting::class, 'id', 'testing_id');
    }

    public function scopeHasTgt($query) {
        return $query->with(['testing_groups', 'testing']);
    }
}
