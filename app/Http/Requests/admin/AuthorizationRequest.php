<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class AuthorizationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'role' => ['required', 'min:3' , 'max:60'],
            'permissions' => ['required', 'array' , 'min:1' , 'max:60'],
        ];
    }
}
