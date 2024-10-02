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
            'address' => [
                'line1' => $this->address_line1,
                'line2' => $this->address_line2,
                'postal_code' => $this->postal_code,
                'city_corporation' => $this->city_corporation,
                'upazila' => $this->upazila,
                'zillah' => $this->zillah,
                'district' => $this->district,
                'country' => $this->country,
            ],
            'data_of_birth' => $this->data_of_birth,
            'gender' => $this->gender == 1 ? 'Male' : 'Female',
            'notes' => $this->notes,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
