<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InitiativeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'department_id' => $this->department_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'category' => $this->category,
            'budget' => $this->budget,
            'spent' => $this->spent,
            'remaining' => $this->budget - $this->spent,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
            'irish_workers_employed' => $this->irish_workers_employed,
            'outcomes' => $this->outcomes,
            'created_at' => $this->created_at,
        ];
    }
}
