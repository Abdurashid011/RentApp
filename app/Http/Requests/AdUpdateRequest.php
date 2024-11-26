<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdUpdateRequest extends FormRequest
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
            'title'       => ['nullable', 'string'],
            'address'     => ['nullable', 'string'],
            'price'       => ['nullable', 'numeric'],
            'rooms'       => ['nullable', 'integer', 'min:1'],
            'square'      => ['nullable', 'numeric'],
            'description' => ['nullable', 'string'],
            'gender'      => ['nullable', 'string', 'in:male,female'],
            'user_id'     => ['nullable', 'integer', 'exists:users,id'],
            'branch_id'   => ['nullable', 'integer', 'exists:branches,id'],
            'status_id'   => ['nullable', 'integer', 'exists:statuses,id'],
        ];
    }
}
