<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            'assigned_user_id' => 'required|integer|numeric|exists:users,id',
            'category_id' => 'required|integer|numeric|exists:categories,id',
            'title' => 'required|min:1|max:10|string',
            'image_path' => 'image|mimes:png,jpg',
            'body' => 'required|min:1|max:50|string',
            'status' => 'required|integer|numeric',
        ];
    }
}
