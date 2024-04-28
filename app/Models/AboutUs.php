<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;

    protected $table = 'about_us';

    protected $fillable = [
        'hci_name',
        'accreditation_no',
        'province',
        'province_name',
        'city',
        'city_name',
        'municipality',
        'municipality_name',
        'barangay',
        'barangay_name',
        'street',
        'subdivision_village',
        'building_no',
        'blk',
        'postal_code'
    ];
}
