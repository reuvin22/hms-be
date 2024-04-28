<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientIvfluid extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'nurse_id',
        'bottle_no',
        'type_of_iv',
        'volume',
        'rate_of_flow',
        'datetime_start',
        'datetime_end',
        'nurse_on_duty',
        'remarks'
    ];
}
