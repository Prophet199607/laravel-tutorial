<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'post_title' => 'required|min:3',
            'post_content' => 'required|min:3|max:500',
            'post_image' => 'file'
        ];
    }

    public function messages()
    {
        return [
            'post_title.required' => 'This is a custom error massage'
        ];
    }

    public function attributes()
    {
        return [
            'post_content' => 'custom attribute'
        ];
    }

    
}
