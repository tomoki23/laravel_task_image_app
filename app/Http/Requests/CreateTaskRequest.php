<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class CreateTaskRequest extends FormRequest
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
            'image' => File::image()->max(2048),
            'body' => 'required|min:1|max:50|string',
            'status' => 'nullable|integer|numeric', Rule::in(config('status.statusLabels')),
        ];
    }
}
