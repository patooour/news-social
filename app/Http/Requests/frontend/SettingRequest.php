<?php

namespace App\Http\Requests\frontend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SettingRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.Auth::user()->id],
/*            'password' => ['required', 'string', 'min:8', 'confirmed'],*/
            'username' => ['required', 'string', 'min:3','max:100', 'unique:users,username,'.Auth::user()->id],
            'phone' => ['required', 'numeric', 'unique:users,phone,'.Auth::user()->id],
            'image' => ['nullable','image','mimes:jpeg,jpg,png','max:2048'],
            'country' => ['nullable', 'string','min:2' ,'max:50'],
            'city' => ['nullable', 'string','min:2', 'max:50'],
            'street' => ['nullable', 'string','min:2', 'max:50'],
        ];
    }
}
