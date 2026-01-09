<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RevenueStream extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'title',
        'description',
        'amount',
        'source_type',
        'source_name',
        'category',
        'is_recurring',
        'frequency',
        'conditions',
    ];

    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2',
        'is_recurring' => 'boolean',
    ];

    public function scopeRecurring($query)
    {
        return $query->where('is_recurring', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('source_type', $type);
    }

    public function getFormattedAmountAttribute()
    {
        return '€' . number_format($this->amount, 0);
    }

    public function getAnnualizedAmountAttribute()
    {
        if (!$this->is_recurring) {
            return $this->amount;
        }

        return match($this->frequency) {
            'monthly' => $this->amount * 12,
            'quarterly' => $this->amount * 4,
            'annual' => $this->amount,
            default => $this->amount,
        };
    }
}
