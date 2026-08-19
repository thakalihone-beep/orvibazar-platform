<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Mass Assignment
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'icon',
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
            'is_active' => 'boolean',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Get the parent category.
     *
     * categories.parent_id -> categories.id
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Get the child categories.
     *
     * One category can have many child categories.
     */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Check if the category is active.
     */
    public function isActive(): bool
    {
        return $this->is_active;
    }

    /**
     * Check if the category is a parent category.
     */
    public function isParent(): bool
    {
        return is_null($this->parent_id);
    }

    /**
     * Check if the category is a child category.
     */
    public function isChild(): bool
    {
        return ! is_null($this->parent_id);
    }
}
