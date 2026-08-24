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

    /**
     * Product reviews.
     *
     * products.id -> reviews.product_id
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods & Accessors
    |--------------------------------------------------------------------------
    */

    /**
     * Get the primary image URL.
     */
    public function getImageUrlAttribute(): string
    {
        if (! empty($this->images) && is_array($this->images)) {
            $first = $this->images[0];
            if (str_starts_with($first, 'http://') || str_starts_with($first, 'https://')) {
                return $first;
            }

            return asset('storage/' . ltrim($first, '/'));
        }

        return 'https://via.placeholder.com/400x400/1a1a1a/ffffff?text=' . urlencode($this->name);
    }

    /**
     * Get the stock status string.
     */
    public function getStockStatusAttribute(): string
    {
        if ($this->isOutOfStock()) {
            return 'out-of-stock';
        }

        return $this->stock_qty <= 5 ? 'low-stock' : 'in-stock';
    }

    /**
     * Check if product is on sale.
     */
    public function getIsOnSaleAttribute(): bool
    {
        return $this->hasDiscount();
    }

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
