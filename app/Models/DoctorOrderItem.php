<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorOrderItem extends Model
{
    use HasFactory;
    protected $primaryKey = 'do_id';
    protected $fillable = [
        'do_id',
        'name',
        'description'
    ];
}
