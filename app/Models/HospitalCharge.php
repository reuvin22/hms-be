<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalCharge extends Model
{
    use HasFactory;

    protected $table = 'hospital_charges';

    protected $fillable = [
        'charge_type_id',
        'charge_category_id',
        'description',
        'code',
        'standard_charge',
        'is_active'
    ];

    public function charge_type() {
        return $this->belongsTo(HospitalChargeType::class, 'charge_type_id', 'id');
    }

    public function charge_category() {
        return $this->belongsTo(HospitalChargeCategory::class, 'charge_category_id', 'id');
    }

    public function scopeCharges($query) {
        return $query->with(['charge_type', 'charge_category'])->where('is_active', 1);
        // dd($result);
    }
}
