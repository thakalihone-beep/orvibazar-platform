<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Mass Assignment
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'cart_id',
        'product_id',
        'product_variation_id',
        'qty',
        'price',
    ];

    /*
    |--------------------------------------------------------------------------
    | Attribute Casting
    |--------------------------------------------------------------------------
    */

    protected function casts(): array
    {
        return [
            'qty' => 'integer',
            'price' => 'decimal:2',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Cart item belongs to a cart.
     *
     * cart_items.cart_id -> carts.id
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * Cart item belongs to a product.
     *
     * cart_items.product_id -> products.id
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Cart item optionally belongs to a product variation.
     *
     * cart_items.product_variation_id -> product_variations.id
     */
    public function variation()
    {
        return $this->belongsTo(ProductVariation::class, 'product_variation_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Check if the cart item has a product variation.
     */
    public function hasVariation(): bool
    {
        return ! is_null($this->product_variation_id);
    }

    /**
     * Calculate the total price for this cart item.
     */
    public function getTotalPrice(): float
    {
        return (float) $this->price * $this->qty;
    }
}
