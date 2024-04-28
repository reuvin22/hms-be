<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DohSubmittedReport extends Model
{
    use HasFactory;

    protected $table = 'doh_submitted_reports';

    protected $fillable = [
        'reporting_year',
        'reporting_status',
        'reported_by',
        'designation',
        'section',
        'department',
        'date_reported'
    ];

    public function getModelAttributes() {
        return [
            'reporting_year' => $this->reporting_year,
            'reporting_status' => $this->reporting_status,
            'reported_by' => $this->reported_by,
            'designation' => $this->designation,
            'section' => $this->section,
            'department' => $this->department,
            'date_reported' => $this->date_reported,
        ];
    }
}
