<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Mass Assignment
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'user_id',
        'vendor_id',
        'title',
        'message',
        'type',
        'read_at',
    ];

    /*
    |--------------------------------------------------------------------------
    | Attribute Casting
    |--------------------------------------------------------------------------
    */

    protected function casts(): array
    {
        return [
            'read_at' => 'datetime',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Notification belongs to a user.
     *
     * notifications.user_id -> users.id
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Notification belongs to a vendor.
     *
     * notifications.vendor_id -> vendors.id
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
     * Check if notification has been read.
     */
    public function isRead(): bool
    {
        return ! is_null($this->read_at);
    }

    /**
     * Check if notification is unread.
     */
    public function isUnread(): bool
    {
        return is_null($this->read_at);
    }

    /**
     * Mark notification as read.
     */
    public function markAsRead(): void
    {
        $this->update([
            'read_at' => now(),
        ]);
    }

    /**
     * Mark notification as unread.
     */
    public function markAsUnread(): void
    {
        $this->update([
            'read_at' => null,
        ]);
    }
}
