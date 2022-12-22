<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionsRequest extends FormRequest
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
            'qs_name'                   => 'required',
            'qs_answer1'                => 'required',
            'qs_answer2'                => 'required',
            'qs_answer_true'            => 'required',
            'ps_category_post_id'       => 'required'
        ];
    }
    public function messages()
    {
        return [
             'qs_name.required'             => 'Bạn không thể để trống trường này ',
             'qs_answer1.required'          => 'Bạn không thể để trống trường này ',
             'qs_answer2.required'          => 'Bạn không thể để trống trường này ',
             'qs_answer_true.required'      => 'Bạn không thể để trống trường này ',
             'ps_category_post_id.required' => 'Bạn không thể để trống trường này ',
        ];
    }
}
