<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class UsersRequest extends FormRequest
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
            'u_name'       => 'required',
            'u_email'      => 'required'.($this->route('id') ? '' : '|unique:users'),
            'u_password'   => ($this->route('id') ? '' : 'required'),
            'u_repassword' => ($this->route('id') ? '' : 'required|').'same:u_password',
            'u_phone'      => 'required|regex:/^[0-9]{7,14}$/',
            'u_address'    => 'required',
            'u_age'        => 'required|regex:/^[0-9]{1,3}$/',
            'u_avatar'     => ($this->route('id') ? '' : 'required|').'|mimes:jpeg,jpg,png'
        ];
    }
    public function messages()
    {
        return [
            'u_name.required'       => ' Bạn không thể để trống trường này !',
            'u_email.required'      => ' Bạn không thể để trống trường này !',
            'u_email.unique'        => ' Email đã tồn tại  !',
            'u_password.required'   => ' Bạn không thể để trống trường này !',
            'u_repassword.required' => ' Bạn không thể để trống trường này !',
            'u_repassword.same'     => ' Mật khẩu xác nhận không đúng !',
            'u_phone.required'      => ' Bạn không thể để trống trường này !',
            'u_phone.regex'         => '  Bạn phải nhập đúng định dạng số và lớn hơn 7 số ',
            'u_avatar.required'     => ' Bạn không thể để trống trường này !',
            'u_avatar.mimes'        => ' Mời bạn nhập đúng định dạng ảnh  !',
            'u_address.required'    => ' Bạn không thể để trống trường này !',
            'u_age.required'        => ' Bạn không thể để trống trường này !',
            'u_age.regex'           => ' Tuổi phải là dạng số và có độ dài từ 1 đến 3 ký tự !'
        ];
    }
}
