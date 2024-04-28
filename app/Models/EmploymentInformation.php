<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploymentInformation extends Model
{
    use HasFactory;

    protected $table = 'employment_informations';

    protected $fillable = [
        'user_id',
        'date_hired',
        'profession_designation_id',
        'specialty_board_cert_id',
        'fulltime_40permanent',
        'fulltime_40contructual',
        'parttime_permanent',
        'parttime_contructual',
        'active_rotating_affil',
        'outsourced',
        'employer_name',
        'employer_address',
        'employer_contract',
        'employer_from',
        'employer_to',
        'position'
    ];
}
