<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BedType extends Model
{
    use HasFactory;

    protected $table = 'bed_types';

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];

}
