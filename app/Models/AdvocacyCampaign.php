<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class AdvocacyCampaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'goal',
        'description',
        'status',
        'petition_count',
        'target_signatures',
        'call_to_action',
        'success_metrics',
        'petition_url',
        'start_date',
        'end_date',
        'is_featured',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'success_metrics' => 'array',
        'is_featured' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($campaign) {
            if (empty($campaign->slug)) {
                $campaign->slug = Str::slug($campaign->title);
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
