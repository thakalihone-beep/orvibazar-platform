<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Mass Assignment
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'user_id',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Cart belongs to a user.
     *
     * carts.user_id -> users.id
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Cart has many cart items.
     *
     * This relationship will work when the cart_items table is created.
     */
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
}
