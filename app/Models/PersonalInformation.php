<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInformation extends Model
{
    use HasFactory;

    protected $table = 'personal_informations';

    protected $fillable = [
        'personal_id',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'birth_date',
        'birth_place',
        'gender',
        'civil_status',
        'contact_no',
        'telephone_no',
        'email',
        'age',
        'province',
        'city_of',
        'municipality',
        'zip_code',
        'barangay',
        'street',
        'no_blk_lot',
        'subdivision_village',
        'nationality',
        'religion',
        'father_name',
        'father_address',
        'father_contact',
        'mother_name',
        'mother_address',
        'mother_contact',
        'spouse_name',
        'spouse_address',
        'spouse_contact',
        'occupation',
        'employer_name',
        'employer_address',
        'employer_contact',
        'is_approved'
    ];
}
