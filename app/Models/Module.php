<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Grant;

class Module extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'modules';

    protected $fillable = [
        'module_id',
        'type',
        'name',
        'menu_group',
        'sort',
        'icon',
        'description'
    ];
    
    public function grant() {
        return $this->belongsTo(Grant::class, 'module_id', 'permission_id');
    }

    public function scopeHasModule($query) {
        $query->with('grant')->orderBy('modules.sort', 'asc');
    }
}
