<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|max:120|unique:admins,email,'.auth('admin')->user()->id,
            'username' => 'required|min:3|max:100|unique:admins,username,'.auth('admin')->user()->id,
            'current_password' => 'required',
            'password' => 'nullable|min:8|max:120',
        ];
    }
}
