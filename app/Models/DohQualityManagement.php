<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DohQualityManagement extends Model
{
    use HasFactory;
    
    protected $table = 'doh_info_quality_mgmts';

    protected $fillable = [
        'quality_mgmt_type_id',
        'description',
        'certifying_body',
        'philhealth_accreditation_id',
        'validation_from',
        'validation_to',
    ];

    public function getModelAttributes() {
        return [
            'quality_mgmt_type_id' => $this->quality_mgmt_type_id,
            'description' => $this->description,
            'certifying_body' => $this->certifying_body,
            'philhealth_accreditation_id' => $this->philhealth_accreditation_id,
            'validation_from' => $this->validation_from,
            'validation_to' => $this->validation_to,
        ];
    }

    public function philhealth_accreditation() {
       return $this->hasOne(DohPhealthAccreditation::class, 'id', 'philhealth_accreditation_id'); 
    }

    public function quality_type() {
        return $this->hasOne(DohQualityManagementType::class, 'id', 'quality_mgmt_type_id');
    }

    public function scopeHasQmt($query) {
        return $query->with(['quality_type', 'philhealth_accreditation']);
    }
}
