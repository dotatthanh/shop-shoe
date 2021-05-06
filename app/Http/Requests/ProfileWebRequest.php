<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileWebRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Trường này là bắt buộc',
            'email.required' => 'Trường này là bắt buộc',
            'phone.required' => 'Trường này là bắt buộc',
            'address.required' => 'Trường này là bắt buộc',
        ];
    }
}
