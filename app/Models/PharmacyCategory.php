<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmacyCategory extends Model
{
    use HasFactory;

    protected $table = 'pharmacy_categories';

    protected $fillable = [
        'category_name'
    ];
}
