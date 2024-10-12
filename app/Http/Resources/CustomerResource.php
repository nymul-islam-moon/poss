<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'data_of_birth' => $this->data_of_birth ? $this->data_of_birth->format('Y-m-d') : null,
            'gender' => $this->gender == 1 ? 'Male' : 'Female',
            'notes' => $this->notes,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            'country' => $this->country ? $this->country->name : null,
            'region_data' => $this->region_data,
            'address1' => $this->address1,
            'address2' => $this->address2,
        ];
    }
}
