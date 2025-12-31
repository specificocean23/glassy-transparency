<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SpendingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'budget_id' => $this->budget_id,
            'department_id' => $this->department_id,
            'category' => $this->category,
            'vendor_name' => $this->vendor_name,
            'description' => $this->description,
            'amount' => $this->amount,
            'status' => $this->status,
            'transaction_date' => $this->transaction_date,
            'document_reference' => $this->document_reference,
            'tags' => $this->tags,
            'is_fossil_fuel_related' => $this->is_fossil_fuel_related,
            'is_green_energy' => $this->is_green_energy,
            'supports_homelessness_initiative' => $this->supports_homelessness_initiative,
            'created_at' => $this->created_at,
        ];
    }
}
