<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class settingRequest extends FormRequest
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
            'site_name'=>'required|string|min:3|max:100',
            'email'=>'required|email|max:150',
            'phone'=>'required|numeric|digits_between:8,20',
            'country'=>'required|string|min:3|max:30',
            'city'=>'required|string|min:3|max:30',
            'street'=>'required|min:3|max:70',
            'facebook'=>'required|max:70',
            'instagram'=>'required|max:70',
            'youtube'=>'required|max:70',
            'twitter'=>'required|max:70',
            'small_desc'=>'required|min:3',
            'logo'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
