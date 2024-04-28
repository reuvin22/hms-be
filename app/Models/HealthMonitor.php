<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthMonitor extends Model
{
    use HasFactory;

    protected $table = 'health_monitors';

    protected $fillable = [
        'health_monitor_id',
        'patient_id',
        'date',
        'hour',
        'respiratory_rate',
        'pulse_rate',
        'temperature'
    ];
}