<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'address'=>'required',
            'phone'=>'required|alpha_num|min:10|max:10',
        ];
    }
    public function messages()
    {
        return[
            'address.required'=>'Bạn chưa nhập địa chỉ nhận hàng!',
            'phone.required'=>'Bạn chưa nhập số điện thoại!',
            'phone.alpha_num'=>'Bạn chỉ được nhập số!',
            'phone.min'=>'Số điện thoại không hợp lệ!',
            'phone.max'=>'Số điện thoại không hợp lệ!',
        ];
    }
}
