<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'slug' => 'required',
            'brand_id' => 'required',
            'supplier_id' => 'required',
            'image' => 'required',
            'price' => 'required|min:1',
            'sku' => 'required|max:255',
            'category_id' => 'required',
            'images' => 'required',
            'name' => 'required',
            'quantity' => 'required|min:1',
        ];
    }

    public function messages() 
    {
        return [
            'title.string' => 'Tên nhà cung cấp không được chứa các ký tự đặc biệt.',
            'title.max' => 'Tên nhà cung cấp không được phép quá 255 ký tự.',
            'title.required' => 'Tên nhà cung cấp là trường bắt buộc.',
            'slug.required' => 'Slug là trường bắt buộc.',
            'brand_id.required' => 'Thương hiệu trường bắt buộc.',
            'supplier_id.required' => 'Nhà cung cấp là trường bắt buộc.',
            'image.required' => 'Ảnh sản phẩm là trường bắt buộc.',
            'price.required' => 'Giá bán là trường bắt buộc.',
            'price.min' => 'Giá bán nhỏ nhất bằng 1.',
            'sku.required' => 'Mã sản phẩm là trường bắt buộc.',
            'sku.max' => 'Mã sản phẩm không được phép quá 255 ký tự.',

            'category_id.required' => 'Danh mục là trường bắt buộc.',
            'images.required' => 'Ảnh chi tiết sản phẩm là trường bắt buộc.',
            'name.required' => 'Tên size là trường bắt buộc.',
            'name.max' => 'Tên size không được phép quá 255 ký tự.',
            'quantity.required' => 'Số lượng sản phẩm là trường bắt buộc.',
            'quantity.min' => 'Số lượng sản phẩm nhỏ nhất bằng 1.',
        ];
    }
}
