<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalHistory extends Model
{
    use HasFactory;

    protected $table = 'approval_histories';

    protected $fillable = [
        'patient_id',
        'patient_name',
        'clerk_name',
        'physician_id',
        'type_approval',
        'status'
    ];

    /**
     * Get the user associated with the ApprovalHistory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function patient()
    {
        return $this->hasOne(Patient::class, 'patient_id', 'patient_id');
    }

    public function physician()
    {
        return $this->hasOne(Identity::class, 'id', 'physician_id');
    }
}
