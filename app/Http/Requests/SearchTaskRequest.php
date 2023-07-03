<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchTaskRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'keyword' => 'nullable|string',
            'category_id' => 'nullable|integer|numeric|exists:categories,id',
            'user_id' => 'nullable|integer|numeric|exists:users,id',
            'status' => 'nullable|integer|numeric'
        ];
    }
}
