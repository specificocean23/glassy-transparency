<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Budget extends Model
{
    use HasFactory;

    protected $table = 'annual_budgets';

    protected $fillable = [
        'year',
        'category',
        'department',
        'allocated_amount',
        'spent_amount',
        'predicted_amount',
        'status',
        'source',
        'notes',
    ];

    protected $casts = [
        'allocated_amount' => 'decimal:2',
        'spent_amount' => 'decimal:2',
        'predicted_amount' => 'decimal:2',
        'year' => 'integer',
    ];

    public function getUtilizationPercentageAttribute()
    {
        if ($this->allocated_amount == 0) {
            return 0;
        }
        return ($this->spent_amount / $this->allocated_amount) * 100;
    }

    public function getRemainingBudgetAttribute()
    {
        return $this->allocated_amount - $this->spent_amount;
    }

    public function scopeByYear($query, $year)
    {
        return $query->where('year', $year);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
