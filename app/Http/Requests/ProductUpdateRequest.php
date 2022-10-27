<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'name'=>'required',
            'price'=>'required|min:4|numeric',
            'body'=>'required',

        ];
    }
    public function messages()
    {
        return[
            'name.required'=>'Bạn chưa nhập tên sản phẩm!',
            'price.required'=>'Bạn chưa nhập giá sản phẩm!',
            'price.min'=>'Giá không được nhỏ hơn 1000',
            'price.number'=>'Chỉ được phép nhập số!',
            // 'promotion.lt'=>'Giá khuyến mãi phải nhỏ hơn giá gốc!',
            'body.required'=>'Sản phẩm chưa có nội dung chi tiết!',
        ];
    }
}
