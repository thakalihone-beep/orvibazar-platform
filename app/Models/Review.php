<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Mass Assignment
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'product_id',
        'user_id',
        'order_item_id',
        'rating',
        'comment',
        'is_approved',
    ];

    /*
    |--------------------------------------------------------------------------
    | Attribute Casting
    |--------------------------------------------------------------------------
    */

    protected function casts(): array
    {
        return [
            'rating' => 'integer',
            'is_approved' => 'boolean',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Review belongs to a product.
     *
     * reviews.product_id -> products.id
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Review belongs to a user.
     *
     * reviews.user_id -> users.id
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Review belongs to an order item.
     *
     * reviews.order_item_id -> order_items.id
     */
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Check if the review is approved.
     */
    public function isApproved(): bool
    {
        return $this->is_approved;
    }

    /**
     * Check if the review is a 5-star review.
     */
    public function isFiveStar(): bool
    {
        return $this->rating === 5;
    }

    /**
     * Check if the review is a 1-star review.
     */
    public function isOneStar(): bool
    {
        return $this->rating === 1;
    }
}
