<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdStoreRequest extends FormRequest
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
            'title'       => ['required', 'string'],
            'address'     => ['nullable', 'string'],
            'price'       => ['required', 'numeric'],
            'rooms'       => ['required', 'integer', 'min:1'],
            'square'      => ['required', 'numeric'],
            'description' => ['nullable', 'string'],
            'gender'      => ['nullable', 'string', 'in:male,female'],
            'user_id'     => ['required', 'integer', 'exists:users,id'],
            'branch_id'   => ['required', 'integer', 'exists:branches,id'],
            'status_id'   => ['required', 'integer', 'exists:statuses,id'],
        ];
    }
}
