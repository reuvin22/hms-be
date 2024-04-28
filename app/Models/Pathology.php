<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pathology extends Model
{
    use HasFactory;

    protected $table = 'pathologies';

    protected $fillable = [
        'test_name',
        'short_name',
        'patho_param_id',
        'patho_category_id',
        'unit',
        'sub_category',
        'report_days',
        'methods',
        'charge'

    ];

    public function pathology_category() {
        return $this->hasOne(PathologyCategory::class, 'id', 'patho_category_id');
    }

    public function pathology_parameters() {
        return $this->hasOne(PathologyParameter::class, 'id', 'patho_param_id');
    }

    public function scopeHasCategory($query) {
        return $query->with(['pathology_category', 'pathology_parameters']);
    }
}
