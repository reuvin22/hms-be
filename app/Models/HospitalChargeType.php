<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalChargeType extends Model
{
    use HasFactory;
    
    protected $table = 'hospital_charge_types';

    protected $fillable = [
        'name',
        'is_active'
    ];
}
