<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'century',
        'tagline',
        'description',
        'long_description',
        'guests',
        'bedrooms',
        'bathrooms',
        'image_url',
        'gallery_images',
        'is_published',
        'is_coming_soon',
        'sort_order',
        'amenities',
        'location',
    ];

    protected $casts = [
        'is_published'   => 'boolean',
        'is_coming_soon' => 'boolean',
        'gallery_images' => 'array',
        'amenities'      => 'array',
        'guests'         => 'integer',
        'bedrooms'       => 'integer',
        'bathrooms'      => 'integer',
        'sort_order'     => 'integer',
    ];

    // -------------------------
    // Scopes
    // -------------------------

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('is_published', true)
                     ->where('is_coming_soon', false);
    }

    // -------------------------
    // Relationships
    // -------------------------

    public function inquiries(): HasMany
    {
        return $this->hasMany(ContactInquiry::class);
    }

    // -------------------------
    // Accessors
    // -------------------------

    public function getGuestSummaryAttribute(): string
    {
        $parts = [];
        if ($this->guests) {
            $parts[] = "{$this->guests} guests";
        }
        if ($this->bedrooms) {
            $parts[] = "{$this->bedrooms} rooms";
        }
        return implode(' · ', $parts);
    }
}
