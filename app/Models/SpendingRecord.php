<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SpendingRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'financial_category_id',
        'county_id',
        'year',
        'amount',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'year' => 'integer',
    ];

    public function financialCategory()
    {
        return $this->belongsTo(FinancialCategory::class);
    }

    public function county()
    {
        return $this->belongsTo(County::class);
    }
}
