<?php

namespace App\Models;

use App\Models\ItemStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventoryIssue extends Model
{
    use HasFactory;

    protected $fillable = [
        'usert_type_id',
        'status_id',
        'issue_to',
        'issue_by',
        'issue_date',
        'return_date',
        'note',
        'category_id',
        'item_id',
        'qty'
    ];

    public function item_category() {
        return $this->hasOne(InventoryItemCategory::class, 'id', 'category_id');
    }

    public function item_status() {
        return $this->hasOne(ItemStatus::class, 'id', 'status_id');
    }

    public function scopeHasCategory($query) {
        return $query->with(['item_status', 'item_category']);
    }
}
