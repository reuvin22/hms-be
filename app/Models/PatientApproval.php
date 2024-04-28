<?php

namespace App\Models;

use App\Models\PersonalInformation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PatientApproval extends Model
{
    use HasFactory;

    protected $table = 'patient_approvals';

    protected $fillable = [
        'patient_info_id',
        'admitting_clerk',
        'admitting_physician',
        'patient_id',
        'status',
        'type_approval',
        'is_approved'
    ];

    public function user_data_info() {
        return $this->hasOne(PersonalInformation::class, 'personal_id', 'patient_id');
    }

    public function physician_data_info() {
        return $this->hasOne(PersonalInformation::class, 'personal_id', 'admitting_physician');
    }

    public function clerk_data_info() {
        return $this->hasOne(User::class, 'user_id', 'admitting_clerk');
    }

    public function scopeHasApprove($query) {
        return $query->with(['user_data_info', 'physician_data_info', 'clerk_data_info'])->where('is_approved', "Pending");
    }
}
