<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Policy extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'policy_type',
        'status',
        'description',
        'introduced_date',
        'target_completion_date',
        'department_id',
        'eu_mandate',
        'impact_assessment',
        'document_url',
        'key_metrics',
    ];

    protected $casts = [
        'introduced_date' => 'date',
        'target_completion_date' => 'date',
        'eu_mandate' => 'boolean',
        'key_metrics' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($policy) {
            if (empty($policy->slug)) {
                $policy->slug = Str::slug($policy->title);
            }
        });
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
