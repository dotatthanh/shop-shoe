<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountCodeRequest extends FormRequest
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
            'code' => 'required|min:4|max:32',
            'type' => 'required'
        ];
    }

    public function messages() 
    {
        return [
            'code.required' => 'Mã giảm giá là trường bắt buộc',
            'code.min' => 'Độ dài tối thiếu 4 ký tự',
            'code.max' => 'Độ dài tối đa 32 ký tự',
            'type.required' => 'Loại giảm giá là trường bắt buộc',
        ];
    }
}
