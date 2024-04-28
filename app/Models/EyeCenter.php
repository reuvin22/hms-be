<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EyeCenter extends Model
{
    use HasFactory;

    protected $table = 'eyecenter_appointments';

    protected $fillable = [
        'patient_name',
        'doctors_agenda',
        'appointment_date',
        'appointment_color'
    ];
}
