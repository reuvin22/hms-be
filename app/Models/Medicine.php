<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'purchase_price',
        'duration_from',
        'duration_to',
        'amount',
        'brand_name',
        'generic_name',
        'dosage',
        'vat',
        'is_active'
    ];
}
