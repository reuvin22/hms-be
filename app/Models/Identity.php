<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identity extends Model
{
    use HasFactory;

    
    protected $table = 'identity';

    protected $fillable = [
        'user_id',
        'date_hired',
        'type_visit',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'age',
        'birth_date',
        'birth_place',
        'gender',
        'civil_status',
        'contact_no',
        'country',
        'province',
        'state_municipality',
        'barangay',
        'street',
        'no_blk_lot',
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
        'tin_no',
        'philhealth_no',
        'sss_no',
        'pagibig_no',
        'hmo_no',
        'prc_no',
        'prc_date_issued',
        'prc_date_expire',
    ];
}
