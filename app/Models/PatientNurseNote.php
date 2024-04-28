<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientNurseNote extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'patient_id',
        'nurse_id',
        'remarks',
    ];
}
