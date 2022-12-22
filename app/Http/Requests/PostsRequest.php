<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostsRequest extends FormRequest
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
            'po_title'              => 'required',
//            'po_category_post_id'   => 'required',
            'po_content'            => 'required'
        ];
    }
    public function messages()
    {
        return [
            'po_title.required'                 => 'Mời bạn nhập tiêu đề bài viết ',
//            'po_category_post_id.required'      => 'Mời bạn chọn danh mục bài viết',
            'po_content.required'               => 'Mời bạn nhập nội dung bài viết'
        ];
    }
}
