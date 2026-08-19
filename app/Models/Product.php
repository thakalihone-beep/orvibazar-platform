<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Mass Assignment
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'vendor_id',
        'category_id',
        'name',
        'slug',
        'description',
        'images',
        'tags',
        'price',
        'discount_price',
        'stock_qty',
        'status',
        'avg_rating',
    ];

    /*
    |--------------------------------------------------------------------------
    | Attribute Casting
    |--------------------------------------------------------------------------
    */

    protected function casts(): array
    {
        return [
            'images' => 'array',
            'tags' => 'array',
            'price' => 'decimal:2',
            'discount_price' => 'decimal:2',
            'stock_qty' => 'integer',
            'avg_rating' => 'decimal:2',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Product belongs to a vendor.
     *
     * products.vendor_id -> vendors.id
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * Product belongs to a category.
     *
     * products.category_id -> categories.id
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Check if product is published.
     */
    public function isPublished(): bool
    {
        return $this->status === 'published';
    }

    /**
     * Check if product is out of stock.
     */
    public function isOutOfStock(): bool
    {
        return $this->status === 'out_of_stock' || $this->stock_qty <= 0;
    }

    /**
     * Check if product has a discount.
     */
    public function hasDiscount(): bool
    {
        return ! is_null($this->discount_price)
            && $this->discount_price < $this->price;
    }

    /**
     * Get the final selling price.
     */
    public function getSellingPrice(): float
    {
        return $this->hasDiscount()
            ? (float) $this->discount_price
            : (float) $this->price;
    }
}
