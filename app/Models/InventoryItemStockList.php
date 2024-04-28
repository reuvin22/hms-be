<?php

namespace App\Models;

use App\Models\InventoryItemCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventoryItemStockList extends Model
{
    use HasFactory;

    protected $fillable = [
        'item',
        'category_id',
        'supplier',
        'date',
        'qty',
        'purchase_price'
    ];

    public function item_category() {
        return $this->hasOne(InventoryItemCategory::class, 'id', 'category_id');
    }

    public function scopeHasCategory($query) {
        return $query->with(['item_category']);
    }
}
