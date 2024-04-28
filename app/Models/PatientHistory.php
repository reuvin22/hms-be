<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientHistory extends Model
{
    use HasFactory;

    protected $table = 'patient_histories';

    protected $fillable = [
        'user_id',
        'category',
        'data'
    ];

    protected $casts = [
        'data' => 'array'
    ];
}
