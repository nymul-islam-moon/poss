<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'email'         => 'required|email|unique:customers,email',
            'phone'         => 'required|string|max:15|unique:customers,phone',
            'date_of_birth' => 'nullable|date',
            'gender'        => 'nullable|integer|in:1,2',
            'country_id'    => 'nullable|exists:countries,id',
            'region_data'   => 'nullable|array',
            'address1'      => 'nullable|string|max:255',
            'address2'      => 'nullable|string|max:255',
            'notes'         => 'nullable|string',
            'created_by'    => 'nullable|exists:users,id',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'first_name'    => 'first name',
            'last_name'     => 'last name',
            'email'         => 'email address',
            'phone'         => 'phone number',
            'date_of_birth' => 'date of birth',
            'gender'        => 'gender',
            'country_id'    => 'country',
            'region_data'   => 'region data',
            'address1'      => 'primary address',
            'address2'      => 'secondary address',
            'notes'         => 'notes',
            'created_by'    => 'creator',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'first_name.required'    => 'The first name is required.',
            'last_name.required'     => 'The last name is required.',
            'email.required'         => 'An email address is required.',
            'email.email'            => 'The email must be a valid email address.',
            'email.unique'           => 'The email has already been taken.',
            'phone.required'         => 'A phone number is required.',
            'phone.unique'           => 'The phone number has already been taken.',
            'date_of_birth.date'     => 'The date of birth must be a valid date.',
            'gender.integer'         => 'The gender must be an integer.',
            'gender.in'              => 'The selected gender is invalid.',
            'country_id.exists'      => 'The selected country is invalid.',
            'region_data.array'      => 'The region data must be an array.',
            'address1.string'        => 'The primary address must be a string.',
            'address2.string'        => 'The secondary address must be a string.',
            'notes.string'           => 'The notes must be a string.',
            'created_by.exists'      => 'The creator must be a valid user.',
        ];
    }
}
