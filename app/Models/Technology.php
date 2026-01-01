<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Technology extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'description',
        'technical_specs',
        'advantages',
        'disadvantages',
        'irish_applications',
        'cost_per_kwh',
        'lifespan_years',
        'efficiency_percent',
        'featured_image',
        'is_featured',
    ];

    protected $casts = [
        'technical_specs' => 'array',
        'cost_per_kwh' => 'decimal:2',
        'efficiency_percent' => 'decimal:2',
        'is_featured' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($technology) {
            if (empty($technology->slug)) {
                $technology->slug = Str::slug($technology->name);
            }
        });
    }

    public function researchPapers(): HasMany
    {
        return $this->hasMany(ResearchPaper::class);
    }
}
