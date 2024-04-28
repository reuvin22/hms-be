<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalChargeCategory extends Model
{
    use HasFactory;

    protected $table = 'hospital_charge_categories';

    protected $fillable = [
        'name',
        'description',
        'charge_type_id'
    ];

    public function charge_type() {
        return $this->belongsTo(HospitalChargeType::class, 'charge_type_id', 'id');
    }

    public function scopeHasChargeType($query) {
        return $query->with(['charge_type']);
    }
}
