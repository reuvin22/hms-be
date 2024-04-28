<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyInformation extends Model
{
    use HasFactory;

    protected $table = 'family_informations';
    
    protected $fillable = [
        'user_id',
        'father_name',
        'father_address',
        'father_contact',
        'mother_name',
        'mother_address',
        'mother_contact',
        'spouse_name',
        'spouse_address',
        'spouse_contact'
    ];
}
