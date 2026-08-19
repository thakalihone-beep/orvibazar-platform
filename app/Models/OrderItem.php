<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Mass Assignment
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'order_id',
        'product_id',
        'product_variation_id',
        'product_name',
        'sku',
        'qty',
        'price',
        'subtotal',
        'fulfillment_status',
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
            'subtotal' => 'decimal:2',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Order item belongs to an order.
     *
     * order_items.order_id -> orders.id
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Order item belongs to a product.
     *
     * order_items.product_id -> products.id
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Order item optionally belongs to a product variation.
     *
     * order_items.product_variation_id -> product_variations.id
     */
    public function variation()
    {
        return $this->belongsTo(
            ProductVariation::class,
            'product_variation_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Check if the item has a product variation.
     */
    public function hasVariation(): bool
    {
        return ! is_null($this->product_variation_id);
    }

    /**
     * Check if fulfillment is pending.
     */
    public function isPending(): bool
    {
        return $this->fulfillment_status === 'pending';
    }

    /**
     * Check if fulfillment is packed.
     */
    public function isPacked(): bool
    {
        return $this->fulfillment_status === 'packed';
    }

    /**
     * Check if fulfillment is shipped.
     */
    public function isShipped(): bool
    {
        return $this->fulfillment_status === 'shipped';
    }

    /**
     * Check if fulfillment is delivered.
     */
    public function isDelivered(): bool
    {
        return $this->fulfillment_status === 'delivered';
    }
}
