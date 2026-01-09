<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FinancialCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'color',
        'is_environmental_positive',
        'is_environmental_negative',
        'is_new_housing',
        'is_current_housing',
        'sort_order',
    ];

    protected $casts = [
        'is_environmental_positive' => 'boolean',
        'is_environmental_negative' => 'boolean',
        'is_new_housing' => 'boolean',
        'is_current_housing' => 'boolean',
    ];

    public function spendingRecords()
    {
        return $this->hasMany(SpendingRecord::class);
    }
}
