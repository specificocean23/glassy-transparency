<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TimelineEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_date',
        'title',
        'description',
        'event_type',
        'amount',
        'category',
        'department',
        'source_url',
        'impact_level',
        'is_featured',
        'is_controversial',
        'tags',
        'media_coverage',
    ];

    protected $casts = [
        'event_date' => 'date',
        'amount' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_controversial' => 'boolean',
        'tags' => 'array',
    ];

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeControversial($query)
    {
        return $query->where('is_controversial', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('event_type', $type);
    }

    public function scopeRecent($query, $days = 90)
    {
        return $query->where('event_date', '>=', now()->subDays($days));
    }

    public function getFormattedAmountAttribute()
    {
        if (!$this->amount) {
            return null;
        }
        return '€' . number_format($this->amount, 0);
    }
}
