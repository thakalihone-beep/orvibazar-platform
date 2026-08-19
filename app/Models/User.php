<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /*
    |--------------------------------------------------------------------------
    | Mass Assignment
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'avatar',
        'is_active',
        'email_verified_at',
    ];

    /*
    |--------------------------------------------------------------------------
    | Hidden Attributes
    |--------------------------------------------------------------------------
    */

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /*
    |--------------------------------------------------------------------------
    | Attribute Casting
    |--------------------------------------------------------------------------
    */

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * User's vendor account.
     *
     * users.id -> vendors.user_id
     */
    public function vendor()
    {
        return $this->hasOne(Vendor::class);
    }

    /**
     * User's orders.
     *
     * users.id -> orders.user_id
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * User's product reviews.
     *
     * users.id -> reviews.user_id
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Check whether the user account is active.
     */
    public function isActive(): bool
    {
        return $this->is_active;
    }

    /**
     * Check whether the user's email is verified.
     */
    public function isVerified(): bool
    {
        return ! is_null($this->email_verified_at);
    }

    /**
     * Check whether the user is a vendor.
     */
    public function isVendor(): bool
    {
        return $this->vendor()->exists();
    }
}
