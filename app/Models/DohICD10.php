<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DohICD10 extends Model
{
    use HasFactory;
    
    protected $table = 'doh_icd10';

    public $timestamps = false;
}
