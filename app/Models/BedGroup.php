<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BedGroup extends Model
{
    use HasFactory;
    
    protected $table = 'bed_groups';

    protected $fillable = [
        'name',
        'description',
        'floor_id',
        'is_active',
        'created_at',
        'updated_at',
    ];

    public function bed_floor() {
        return $this->belongsTo(BedFloor::class, 'floor_id', 'id');
    }

    public function scopeHasBedFloor($query) {
        return $query->with(['bed_floor'])->where('is_active', 1);
    }
}
