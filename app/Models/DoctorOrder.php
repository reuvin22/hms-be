<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'physician_id',
        'date_time',
        'progress_notes',
        'physician_order',
        'nurse_incharge'
    ];

    public function order_lists()
    {
        return $this->hasMany(OrderList::class, 'order_id', 'id');
    }

    public function progress_notes()
    {
        return $this->hasMany(ProgressNotes::class, 'order_id', 'id');
    }

    public function scopeOrderByCreatedAt($query, $sort = 'desc') {
        return $query->orderBy('created_at', $sort);
    }

    public function scopeHasScope($query)
    {
        return $query->with(['progress_notes', 'order_lists'])->get();
    }
}
