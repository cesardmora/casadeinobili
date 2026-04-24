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
        'airbnb_url',
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

    public function getImageUrlAttribute($value): ?string
    {
        return self::preferWebp($value);
    }

    public function getGalleryImagesAttribute($value): array
    {
        $decoded = is_array($value) ? $value : json_decode($value ?? '[]', true);

        if (! is_array($decoded)) {
            return [];
        }

        return array_map([self::class, 'preferWebp'], $decoded);
    }

    protected static function preferWebp(?string $path): ?string
    {
        if (! $path || preg_match('#^https?://#', $path) === 1) {
            return $path;
        }

        $webpPath = preg_replace('/\.(jpe?g|png)$/i', '.webp', $path);

        if (is_string($webpPath) && file_exists(public_path($webpPath))) {
            return $webpPath;
        }

        return $path;
    }
}
