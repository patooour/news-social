<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'=> 'required|string|max:255|min:3',
            'email'=> 'required|email|unique:users,email',
            'username'=> 'required|unique:users,username',
            'phone'=> 'required|unique:users,phone|max:20',
            'image'=> 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'password'=> 'required|confirmed',
            'country'=> 'required|string|max:20|min:3',
            'city'=> 'required|string|max:20|min:3',
            'street'=> 'required|string|max:50|min:3',
            'status'=> 'in:0,1',
            'email_verified_at'=> 'in:0,1',
        ];
    }
}
