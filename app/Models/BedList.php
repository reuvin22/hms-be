<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BedList extends Model
{
    use HasFactory;

    protected $table = 'bed_lists';

    protected $fillable = [
        'name',
        'bed_type_id',
        'bed_group_id',
        'is_active',
    ];


    public function bed_type() {
        return $this->belongsTo(BedType::class, 'bed_type_id', 'id');
    }

    public function bed_group() {
        return $this->belongsTo(BedGroup::class, 'bed_group_id', 'id');
    }

    public function scopeHasBedList($query) {
        return $query->with(['bed_type', 'bed_group', 'bed_group.bed_floor']);
    }
}
