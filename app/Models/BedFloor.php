<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BedFloor extends Model
{
    use HasFactory;

    
    protected $table = 'bed_floors';

    protected $fillable = [
        'floor',
        'description',
        'created_at',
        'updated_at',
    ];
}
