<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemStatus extends Model
{
    use HasFactory;

    protected $table = 'item_statuses';

    /**
     * Get the user that owns the ItemStatus
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function inventoryStockList()
    {
        return $this->belongsTo(InventoryIssue::class, 'status_id', 'id');
    }
}
