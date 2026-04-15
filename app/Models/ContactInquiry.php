<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactInquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'property_id',
        'arrival_date',
        'departure_date',
        'guests',
        'message',
        'inquiry_type',
        'status',
        'ip_address',
        'notes',
    ];

    protected $casts = [
        'arrival_date'   => 'date',
        'departure_date' => 'date',
        'guests'         => 'integer',
    ];

    // -------------------------
    // Relationships
    // -------------------------

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    // -------------------------
    // Scopes
    // -------------------------

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // -------------------------
    // Helpers
    // -------------------------

    public function getInquiryTypeLabelAttribute(): string
    {
        return match($this->inquiry_type) {
            'rental'  => 'Alquiler',
            'wedding' => 'Boda',
            'dossier' => 'Dossier Profesional',
            default   => 'Otro',
        };
    }
}
