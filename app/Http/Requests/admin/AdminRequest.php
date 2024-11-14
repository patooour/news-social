<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
        $admin_id = $this->route('admin');
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admins,email,' . $admin_id,
            'username' => 'required|min:3|max:255|unique:admins,username,' . $admin_id,
            'status' => 'nullable|in:0,1',
            'role_id' => 'required|exists:authorizations,id',
        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['password'] = ['nullable', 'confirmed', 'min:6', 'max:100'];

        }else{
            $rules['password'] = ['required', 'confirmed', 'min:6', 'max:100'];

        }
        return $rules;
    }
}
