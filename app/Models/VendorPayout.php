<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorPayout extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Mass Assignment
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'vendor_id',
        'order_id',
        'order_amount',
        'commission_amount',
        'payout_amount',
        'status',
        'transaction_id',
        'paid_at',
    ];

    /*
    |--------------------------------------------------------------------------
    | Attribute Casting
    |--------------------------------------------------------------------------
    */

    protected function casts(): array
    {
        return [
            'order_amount' => 'decimal:2',
            'commission_amount' => 'decimal:2',
            'payout_amount' => 'decimal:2',
            'paid_at' => 'datetime',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Vendor payout belongs to a vendor.
     *
     * vendor_payouts.vendor_id -> vendors.id
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * Vendor payout belongs to an order.
     *
     * vendor_payouts.order_id -> orders.id
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Check if payout is pending.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if payout is processing.
     */
    public function isProcessing(): bool
    {
        return $this->status === 'processing';
    }

    /**
     * Check if payout is paid.
     */
    public function isPaid(): bool
    {
        return $this->status === 'paid';
    }

    /**
     * Check if payout failed.
     */
    public function isFailed(): bool
    {
        return $this->status === 'failed';
    }
}
