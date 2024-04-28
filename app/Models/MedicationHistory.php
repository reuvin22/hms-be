<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicationHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'physician_id',
        'medicine_id',
        'dosage',
        'form',
        'qty',
        'frequency',
        'sig',
        'status'
    ];
}
