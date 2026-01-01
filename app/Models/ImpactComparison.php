<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImpactComparison extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subject_type',
        'subject_name',
        'co2_tonnes',
        'equivalent_cars',
        'equivalent_trees_needed',
        'equivalent_area_flooded',
        'visual_metaphor',
        'data_sources',
        'year',
        'is_featured',
    ];

    protected $casts = [
        'co2_tonnes' => 'decimal:2',
        'equivalent_area_flooded' => 'decimal:2',
        'data_sources' => 'array',
        'is_featured' => 'boolean',
    ];
}
