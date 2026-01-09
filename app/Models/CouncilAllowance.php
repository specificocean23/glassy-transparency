<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CouncilAllowance extends Model
{
    use HasFactory;

    protected $fillable = [
        'county',
        'year',
        'amount',
        'notes',
    ];

    protected $casts = [
        'year' => 'integer',
        'amount' => 'decimal:2',
    ];

    public function scopeForCounty($query, string $county)
    {
        return $query->where('county', $county);
    }

    public function scopeForYear($query, int $year)
    {
        return $query->where('year', $year);
    }
}
