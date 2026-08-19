<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Mass Assignment
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'vendor_id',
        'code',
        'discount_type',
        'discount_value',
        'min_order_amount',
        'usage_limit',
        'used_count',
        'expires_at',
        'is_active',
    ];

    /*
    |--------------------------------------------------------------------------
    | Attribute Casting
    |--------------------------------------------------------------------------
    */

    protected function casts(): array
    {
        return [
            'discount_value' => 'decimal:2',
            'min_order_amount' => 'decimal:2',
            'usage_limit' => 'integer',
            'used_count' => 'integer',
            'expires_at' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Coupon belongs to a vendor.
     *
     * coupons.vendor_id -> vendors.id
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Check if the coupon is active.
     */
    public function isActive(): bool
    {
        return $this->is_active;
    }

    /**
     * Check if the coupon has expired.
     */
    public function isExpired(): bool
    {
        return $this->expires_at !== null
            && $this->expires_at->isPast();
    }

    /**
     * Check if the coupon has reached its usage limit.
     */
    public function hasReachedUsageLimit(): bool
    {
        return $this->usage_limit !== null
            && $this->used_count >= $this->usage_limit;
    }

    /**
     * Check if the coupon can currently be used.
     */
    public function isUsable(): bool
    {
        return $this->is_active
            && ! $this->isExpired()
            && ! $this->hasReachedUsageLimit();
    }

    /**
     * Check if the coupon uses percentage discount.
     */
    public function isPercentage(): bool
    {
        return $this->discount_type === 'percentage';
    }

    /**
     * Check if the coupon uses flat discount.
     */
    public function isFlat(): bool
    {
        return $this->discount_type === 'flat';
    }
}
