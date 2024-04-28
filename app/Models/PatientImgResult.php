<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientImgResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'physician_id',
        'test_name',
        'imaging_src',
        'comparison',
        'indication',
        'findings',
        'impressions'
    ];

    public function patient_info() {
        return $this->hasOne(PersonalInformation::class, 'personal_id', 'patient');
    }

    public function physician_info() {
        return $this->hasOne(PersonalInformation::class, 'personal_id', 'physician_id');
    }

    public function scopeHasInformation($query, $request) {
        $query->with(['patient_info', 'physician_info']);

        if($request->has('patient_id')) {
            $query->where('patient_id', $request->patient_id);
        }

        if($request->has('sort') && $request->sort === 'created_at') {
            $query->orderBy('created_at', 'desc');
        }

        return $query;
    }
}
