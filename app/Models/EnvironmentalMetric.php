<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EnvironmentalMetric extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'metric_type',
        'value',
        'unit',
        'reference_year',
        'data_source',
        'description',
        'visual_representation',
        'region',
        'is_featured',
    ];

    protected $casts = [
        'visual_representation' => 'array',
        'value' => 'decimal:2',
        'is_featured' => 'boolean',
    ];
}
