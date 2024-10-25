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
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admins,email,'.$admin_id,
            'username' => 'required|min:3|max:255|unique:admins,username,'.$admin_id,
            'password' => 'required|confirmed|min:6|max:100',
            'status' => 'nullable|in:0,1',
            'role_id' => 'required|exists:authorizations,id',
        ];
    }
}
