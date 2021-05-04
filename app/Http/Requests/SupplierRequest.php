<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'address' => 'required|max:255',
            'phone' => 'required|size:10|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'slug' => 'required',
        ];
    }

    public function messages() 
    {
        return [
            'title.string' => 'Tên nhà cung cấp không được chứa các ký tự đặc biệt.',
            'title.max' => 'Tên nhà cung cấp không được phép quá 255 ký tự.',
            'title.required' => 'Tên nhà cung cấp là trường bắt buộc.',
            'slug.required' => 'Slug là trường bắt buộc.',
            'address.required' => 'Địa chỉ là trường bắt buộc.',
            'address.max' => 'Địa chỉ không được phép quá 255 ký tự.',
            'phone.required' => 'Số điện thoại là trường bắt buộc.',
            'phone.size' => 'Số điện thoại phải có 10 số.',
            'phone.unique' => 'Số điện thoại đã tồn tại.',
            'email.required' => 'Email là trường bắt buộc.',
            'email.string' => 'Email không được chứa các ký tự đặc biệt.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',
            'email.max' => 'Email không được phép quá 255 ký tự.',
        ];
    }
}
