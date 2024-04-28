<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DohInfoClassification extends Model
{
    use HasFactory;
    
    protected $table = 'doh_info_classifications';

    protected $fillable = [
        'service_capability_id',
        'general_id',
        'specialty_id',
        'specialty_specify',
        'trauma_capability_id',
        'nature_of_ownership_id',
        'government_id',
        'national_id',
        'local_id',
        'private_id',
        'ownership_other',
    ];

    public function getModelAttributes() {
        return [
            'service_capability_id' => $this->service_capability_id,
            'general_id' => $this->general_id,
            'specialty_id' => $this->specialty_id,
            'specialty_specify' => $this->specialty_specify,
            'trauma_capability_id' => $this->trauma_capability_id,
            'nature_of_ownership_id' => $this->nature_of_ownership_id,
            'government_id' => $this->government_id,
            'national_id' => $this->national_id,
            'local_id' => $this->local_id,
            'private_id' => $this->private_id,
            'ownership_other' => $this->ownership_other
        ];
    }

    public function service_capability() {
        return $this->hasOne(DohServiceCapability::class, 'id', 'service_capability_id');
    }

    public function scopeHasDsc($query) {
        return $query->with(['service_capability']);
    }
}
