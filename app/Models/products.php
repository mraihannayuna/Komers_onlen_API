<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class products extends Model
{
    use HasFactory;

        protected $fillable = [
        'product',
        'price',
        'image',
        'user_id',
        'description',
        'category_id',
    ];

    /**
 * Get the user that owns the posts
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
public function seller(): BelongsTo
{
    return $this->belongsTo(User::class, 'user_id', 'id');
}
    /**
     * Get all of the comments for the posts
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(reviews::class, 'product_id', 'id');
    }

    /**
     * Get the user associated with the storages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(categories::class, 'product_id', 'id');
    }

    /**
     * Get the user associated with the product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category(): HasOne
    {
        return $this->hasOne(categories::class, 'category_id', 'id');
    }


}
