<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientBilling extends Model
{
    use HasFactory;

    protected $table = 'patient_billings';

    protected $fillable = [
        'patient_id',
        'physician_id',
        'physician_charge',
        'hospital_charge',
        'other_charge',
        'discount',
        'tax',
        'gross_total',
        'net_amount',
        'total_amount'
    ];
}
