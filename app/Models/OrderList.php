<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    use HasFactory;

    protected $table = "doctor_order_lists";

    protected $fillable = [
        'order_id',
        'patient_id',
        'physician_id',
        'nurse_incharge',
        'name',
        'description'
    ];

    public function doctor_orders()
    {
        return $this->belongsTo(DoctorOrder::class, 'id', 'order_id');
    }
}
