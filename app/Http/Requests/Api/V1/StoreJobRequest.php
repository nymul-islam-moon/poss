<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobRequest extends FormRequest
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
            'name'              => 'required|string|max:255',
            'description'       => 'required|string|max:255',
            'min_salary'        => 'required|numeric',
            'max_salary'        => 'required|numeric'
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
            'name'          => 'Job Name',
            'description'   => 'Job Description',
            'min_salary'    => 'Minimum salary',
            'max_salary'    => 'Maximum salary'
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
            'name.required'             => 'The job name is required.',
            'description.required'      => 'The description is required.',
            'min_salary.required'       => 'The minimum salary is required.',
            'max_salary.required'       => 'The maximum salary is required.',
        ];
    }
}
