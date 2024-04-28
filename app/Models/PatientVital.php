<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientVital extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'nurse_id',
        'bp',
        'hr',
        'temp',
        'o2_sat',
        'height',
        'weight',
        'bmi'
    ];
}
