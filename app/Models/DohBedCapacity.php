<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DohBedCapacity extends Model
{
    use HasFactory;
    
    protected $table = 'doh_info_bed_capacities';

    protected $fillable = [
        'abc',
        'implementing_beds',
        'bor'
    ];

    public function getModelAttributes() {
        return [
            'abc' => $this->abc,
            'implementing_beds' => $this->implementing_beds,
            'bor' => $this->bor
        ];
    }
}
