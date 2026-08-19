<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Mass Assignment
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'user_id',
        'shipping_address_id',
        'order_number',
        'subtotal',
        'shipping_fee',
        'discount_amount',
        'total_amount',
        'status',
        'payment_status',
    ];

    /*
    |--------------------------------------------------------------------------
    | Attribute Casting
    |--------------------------------------------------------------------------
    */

    protected function casts(): array
    {
        return [
            'subtotal' => 'decimal:2',
            'shipping_fee' => 'decimal:2',
            'discount_amount' => 'decimal:2',
            'total_amount' => 'decimal:2',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Order belongs to a user.
     *
     * orders.user_id -> users.id
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Order belongs to a shipping address.
     *
     * orders.shipping_address_id -> shipping_addresses.id
     */
    public function shippingAddress()
    {
        return $this->belongsTo(ShippingAddress::class);
    }

    /**
     * Order has many order items.
     *
     * This relationship will work after creating the order_items table.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Check if the order is pending.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if the order is confirmed.
     */
    public function isConfirmed(): bool
    {
        return $this->status === 'confirmed';
    }

    /**
     * Check if the order is processing.
     */
    public function isProcessing(): bool
    {
        return $this->status === 'processing';
    }

    /**
     * Check if the order has been shipped.
     */
    public function isShipped(): bool
    {
        return $this->status === 'shipped';
    }

    /**
     * Check if the order has been delivered.
     */
    public function isDelivered(): bool
    {
        return $this->status === 'delivered';
    }

    /**
     * Check if the order is cancelled.
     */
    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    /**
     * Check if the order has been returned.
     */
    public function isReturned(): bool
    {
        return $this->status === 'returned';
    }

    /**
     * Check if the order has been paid.
     */
    public function isPaid(): bool
    {
        return $this->payment_status === 'paid';
    }

    /**
     * Check if the order is unpaid.
     */
    public function isUnpaid(): bool
    {
        return $this->payment_status === 'unpaid';
    }

    /**
     * Check if the order has been refunded.
     */
    public function isRefunded(): bool
    {
        return $this->payment_status === 'refunded';
    }
}
