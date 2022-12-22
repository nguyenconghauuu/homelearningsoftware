<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CategoryPostRequest extends FormRequest
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
            'cpo_name' => 'required|unique:categoryposts,cpo_name,' . $this->id,
        ];
    }

    public function messages()
    {
        return [
            'cpo_name.required' => ' Mời bạn nhập tên danh mục ',
            'cpo_name.unique'   => ' Tên danh mục đã tồn tại'
        ];
    }
}
