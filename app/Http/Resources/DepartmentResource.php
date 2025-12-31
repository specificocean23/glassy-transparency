<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'head_name' => $this->head_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'annual_budget' => $this->annual_budget,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
        ];
    }
}
