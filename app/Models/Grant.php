<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Grant extends Model
{
    use HasFactory;

    protected $table = 'grants';

    protected $guarded = ['id'];
    
    protected $fillable = [
        'permission_id',
        'identity_id',
        'menu_group',
        'sort',
        'created_at',
        'updated_at'
    ];
    
    public $incrementing = false;
    
    public function permission() {
        return $this->belongsTo(Permission::class, 'permission_id', 'permission_id');
    }

    public function module() {
        return $this->belongsTo(Module::class, 'permission_id', 'module_id');
    }

    public function scopeHasGrant($query) {

        $query->with(['permission', 'module'])->where('identity_id', Auth::user()->user_id)->orderBy('sort', 'asc');
    }
}
