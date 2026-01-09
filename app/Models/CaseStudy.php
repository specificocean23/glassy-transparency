<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class CaseStudy extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'location',
        'summary',
        'full_content',
        'jobs_created',
        'investment_amount',
        'co2_reduced',
        'energy_generated_mwh',
        'featured_image',
        'key_stats',
        'initiative_id',
        'county_id',
        'published_at',
        'is_featured',
    ];

    protected $casts = [
        'key_stats' => 'array',
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
        'investment_amount' => 'decimal:2',
        'co2_reduced' => 'decimal:2',
        'energy_generated_mwh' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($caseStudy) {
            if (empty($caseStudy->slug)) {
                $caseStudy->slug = Str::slug($caseStudy->title);
            }
        });
    }

    public function initiative(): BelongsTo
    {
        return $this->belongsTo(Initiative::class);
    }

    public function county(): BelongsTo
    {
        return $this->belongsTo(County::class);
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc');
    }
}
