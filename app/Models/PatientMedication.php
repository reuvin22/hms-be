<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientMedication extends Model
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

    public function medicine() {
        return $this->hasOne(Medicine::class, 'id', 'medicine_id');
    }

    public function scopeHasMedicine($query, $request) {
        return $query->with(['medicine'])->where('patient_id', $request->patient_id);
    }
}
