<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientTest extends Model
{
    use HasFactory;

    protected $table = 'patient_tests';

    protected $fillable = [
        'patient_id',
        'physician_id',
        'test_id',
        'pathology_cat_id',
        'lab_category',
        'status',
        'charge'
    ];
}
