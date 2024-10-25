<?php

namespace App\Http\Requests\frontend;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name'=>'required|string|min:3|max:100',
            'email'=>'required|email|min:3|max:100',
            'phone'=>'required|numeric',
            'title'=>'required|string|min:3|max:60',
            'body'=>'required|min:10|max:200',
        ];
    }
}