<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $data =  [
            'title' => 'required|string|min:3|max:50',
            'desc' => 'required|min:10',
            'small_desc' => 'required|min:30|max:170',
            'category_id' => 'required|exists:categories,id',
            'comment_able' => 'in:on,off,1,0',
            'status' => 'nullable|in:0,1',

            'image.*' => 'mimes:jpeg,png,jpg,gif,svg,webp,JPG,JPEG,PNG|max:3000'
        ];
        if (request()->is('api/account/posts/update/*')){
            $data['image'] = 'nullable';
        }else{
            $data['image'] = 'required';
        }
        return $data;
    }
}
