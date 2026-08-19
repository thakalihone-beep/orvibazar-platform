<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Mass Assignment
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'product_id',
        'attribute_name',
        'attribute_value',
        'price_modifier',
        'stock_qty',
        'sku',
    ];

    /*
    |--------------------------------------------------------------------------
    | Attribute Casting
    |--------------------------------------------------------------------------
    */

    protected function casts(): array
    {
        return [
            'price_modifier' => 'decimal:2',
            'stock_qty' => 'integer',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Product variation belongs to a product.
     *
     * product_variations.product_id -> products.id
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Check if variation is in stock.
     */
    public function isInStock(): bool
    {
        return $this->stock_qty > 0;
    }

    /**
     * Check if variation is out of stock.
     */
    public function isOutOfStock(): bool
    {
        return $this->stock_qty <= 0;
    }
}
