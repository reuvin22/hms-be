<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DohStaffingPatern extends Model
{
    use HasFactory;

    protected $table = 'doh_staffing_patterns';

    protected $fillable = [
        'profession_designation',
        'specialty_board_certified',
        'fulltime_40permament',
        'fulltime_40contructual',
        'parttime_permanent',
        'parttime_contructual',
        'active_rotating_affiliate',
        'outsourced'
    ];

    public function getModelAttributes() {
        return [
            'profession_designation' => $this->profession_designation,
            'specialty_board_certified' => $this->specialty_board_certified,
            'fulltime_40permament' => $this->fulltime_40permament,
            'fulltime_40contructual' => $this->fulltime_40contructual,
            'parttime_permanent' => $this->parttime_permanent,
            'parttime_contructual' => $this->parttime_contructual,
            'active_rotating_affiliate' => $this->active_rotating_affiliate,
            'outsourced' => $this->outsourced,
        ];
    }

    
}
