<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressNotes extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'patient_id',
        'physician_id',
        'progress_notes',
        'nurse_incharge',
    ];

    public function doctor_orders()
    {
        return $this->belongsTo(DoctorOrder::class, 'id', 'order_id');
    }
}
