<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class County extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'is_federal',
        'sort_order',
    ];

    protected $casts = [
        'is_federal' => 'boolean',
    ];

    public function spendingRecords()
    {
        return $this->hasMany(SpendingRecord::class);
    }

    public function caseStudies()
    {
        return $this->hasMany(CaseStudy::class);
    }
}
