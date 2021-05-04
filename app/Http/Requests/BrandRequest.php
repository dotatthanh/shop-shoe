<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
            'title' => 'required',
            'slug' => 'required',
        ];
    }

    public function messages() 
    {
        return [
            'title.required' => 'Tên danh mục là trường bắt buộc',
            'slug.required' => 'Slug là trường bắt buộc',
        ];
    }
}
