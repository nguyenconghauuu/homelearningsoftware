<?php

namespace App\Http\Controllers\AuthAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use Auth;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Input;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admins');
    }

    public function getLogin()
    {
        return view('authen.login');
    }
    /**
     * @param Request $request
     */
    public function postLogin(Request $request)
    {
        // bat loi dang nhap  
        $this->validate($request,$this->rule(),$this->messages());

       // kiem tra dang nhap 
        if(Auth::guard('admins')->attempt(['email' => $request->email,'password' => $request->password],$request->remember))
        {
            // dang nhap thanh cong 
            return redirect()->intended(route('admins.home.index'));
        }
        // dang nhap that bai 
        return redirect()->back()->withInput($request->only('email','remember','password'));

    }
    /**
     * dieu kien dang nhap 
     */
    public function rule()
    {
        return [
            'email'     =>  'required|email|max:255',
            'password'  =>  'required|regex:/^[a-z0-9A-Z_-]{6,100}$/'
        ];
    }
    /**
     * custome message errors
     */
    public function messages()
    {
        return [
            'email.required'        =>  'Vui lòng nhập email',
            'email.email'           =>  'Email chưa xác nhận',
            'email.max'             =>  'Địa chỉ email quá dài',
            'password.required'     =>  'Vui lòng nhập mật khẩu',
            'password.regex'        =>  'Mật khẩu chứa ký tự đặc biệt'
        ];
    }
}
