<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SlidesRequest extends FormRequest
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
            'title'     => 'required',
            'url'       => 'required',
            'images'      => 'required:mimes:jpeg,jpg,png',
        ];
    }
    public function messages()
    {
        return [
            'title.required'    => ' Mời bạn điền nội dung ',
            'url.required'      => ' Mời bạn điền nội dung ',
            'images.required'   => ' Mời bạn điền nội dung ',
            'images.mimes'      => ' Mời bạn chọn đúng định dạng ảnh'
        ];
    }
}
