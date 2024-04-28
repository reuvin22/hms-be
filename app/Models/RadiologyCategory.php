<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RadiologyCategory extends Model
{
    use HasFactory;

    protected $table = 'radiology_categories';

    protected $fillable = [
        'category_name',
        'description'
    ];

    /**
     * Get the user that owns the RadiologyCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function radiology()
    {
        return $this->belongsTo(Radiology::class, 'radio_cat_id', 'id');
    }
}
