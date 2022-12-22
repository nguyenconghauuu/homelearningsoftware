<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailRequest extends FormRequest
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
            'e_email'        => 'required',
            'e_host'         => 'required',
            'e_drive'        => 'required',
            'e_post'         => 'required',
            'e_password'     => 'required'
        ];
    }
    public function messages()
    {
        return [
            'e_email.required'         => ' Bạn không được để trống trường này  ',
            'e_host.required'          => ' Bạn không được để trống trường này  ',
            'e_drive.required'         => ' Bạn không được để trống trường này  ',
            'e_post.required'          => ' Bạn không được để trống trường này  ',
            'e_password.required'      => ' Bạn không được để trống trường này  ',

        ];
    }
}
