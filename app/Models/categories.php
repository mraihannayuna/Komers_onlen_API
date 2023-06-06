<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class categories extends Model
{
    use HasFactory;

        protected $fillable = [
        'category',
    ];

    /**
     * Get the user that owns the categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(products::class, 'category', 'id');
    }

}
