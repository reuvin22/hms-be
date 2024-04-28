<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalPhysicianCharge extends Model
{
    use HasFactory;

    protected $table = 'hospital_physician_charges';

    protected $fillable = [
        'doctor_id',
        'standard_charge',
        'standard_charge_type',
        'is_active'
    ];

    public function identity() {
        return $this->hasOne(Identity::class, 'user_id', 'doctor_id');
    }

    public function scopePhysicianOPDCharge($query) {
        return $query->with(['identity'])
            ->where('is_active', 1)
            ->where('standard_charge_type', 'opd');
    }

    public function scopePhysicianERCharge($query) {
        return $query->with(['identity'])
            ->where('is_active', 1)
            ->where('standard_charge_type', 'er');
    } 
}
