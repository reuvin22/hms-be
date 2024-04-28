<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PathologyCategory extends Model
{
    use HasFactory;

    protected $table = 'pathology_categories';

    protected $fillable = [
        'category_name',
        'description',
        'created_at'
    ];

    /**
     * Get the user that owns the PathologyCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    // public function pathology_category()
    // {
    //     return $this->belongsTo(Pathology::class, 'id', 'patho_category_id');
    // }
}
