<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DohHospOptMinorOpt extends Model
{
    use HasFactory;
    
    protected $table = 'doh_hosp_opt_minor_opts';

    protected $fillable = [
        'operation_code',	
        'surgical_operation',	
        'number'
    ];

    public function getModelAttributes() {
        return [
            'operation_code' => $this->operation_code,	
            'surgical_operation' => $this->surgical_operation,	
            'number' => $this->number
        ];
    }
}
