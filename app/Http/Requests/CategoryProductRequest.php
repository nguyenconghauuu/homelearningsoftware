<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CategoryProductRequest extends FormRequest
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
     public function rules(Request $request)
    {
        
        return [
            'cpr_name'        => 'required'
        ];
    }
  
    public function messages()
    {
        return [
            'cpr_name.required'        => ' Mời bạn nhập tên danh mục ',
            // 'name.unique'          => ' Tên danh mục đã tồn tại'
        ];
    }
}
