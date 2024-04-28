<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Radiology extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_name',
        'test_type',
        'radio_cat_id',
        'charge'
    ];

    public function radiology_category() {
        return $this->hasOne(RadiologyCategory::class, 'id', 'radio_cat_id');
    }

    public function scopeHasCategory($query) {
        return $query->with(['radiology_category']);
    }
}
