<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SeaLevelProjection extends Model
{
    use HasFactory;

    protected $fillable = [
        'region',
        'year_2030',
        'year_2050',
        'year_2100',
        'affected_area_km2',
        'population_at_risk',
        'economic_value_at_risk',
        'description',
        'coordinates',
    ];

    protected $casts = [
        'year_2030' => 'decimal:2',
        'year_2050' => 'decimal:2',
        'year_2100' => 'decimal:2',
        'affected_area_km2' => 'decimal:2',
        'economic_value_at_risk' => 'decimal:2',
        'coordinates' => 'array',
    ];
}
