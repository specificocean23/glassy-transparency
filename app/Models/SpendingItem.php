<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SpendingItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'title',
        'description',
        'amount',
        'category',
        'department',
        'vendor',
        'location',
        'procurement_method',
        'status',
        'justification',
        'source_document',
        'is_questionable',
        'public_interest_score',
    ];

    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2',
        'is_questionable' => 'boolean',
        'public_interest_score' => 'integer',
    ];

    public function scopeQuestionable($query)
    {
        return $query->where('is_questionable', true);
    }

    public function scopeHighInterest($query)
    {
        return $query->where('public_interest_score', '>=', 70);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function getFormattedAmountAttribute()
    {
        return '€' . number_format($this->amount, 0);
    }

    public function getCostPerCapitaAttribute()
    {
        // Assuming Irish population of 5.2 million
        return $this->amount / 5200000;
    }
}
