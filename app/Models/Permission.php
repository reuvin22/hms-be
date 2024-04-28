<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Permission extends Model
{
    use HasFactory;

    
    protected $table = 'permissions';

    public function module() {
        return $this->belongsTo(Module::class, 'module_id', 'module_id');
    }

    public function scopeHasPermission($query) {
        $query->with('module');
    }
}
