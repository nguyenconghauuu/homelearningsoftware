<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

  

    public function getRegister()
    {
        // lay danh muc cap 1
        $categoryLevel1 = \DB::table('categoryposts')->where('cpo_parent_id',0)->orderBy('id','ASC')->get();
        \View::share('categoryLevel1', $categoryLevel1);
        return view('accounts.register');
    }
    protected function postRegister(Request $request)
    {

        //  them moi thanh vien'
        $this->validate($request , $this->rule(), $this->messages());
        $data = $request->all();
        $data['u_password'] = bcrypt($request->u_password);
        unset($data['_token']);


        try{
            $idUser =  User::create($data);
        }catch (\Exception $e)
        {
            dump(" Error Create User : " .$e->getMessage());
        }

        return redirect()->route('get.dangky.user')->with('message',' Đăng ký thành công mời bạn đăng nhập  !!! ');

    }
    protected function rule()
    {
        return [
            'u_name'     => 'required|string|max:255',
            'u_email'    => 'required|string|email|max:255|unique:users',
            'u_password' => 'required|string|min:6',
        ];
    }
    protected function messages()
    {
        return [
            'u_name.required'        =>  'Vui lòng nhập tên ',
            'u_email.required'        =>  ' Vui lòng nhập email ',
            'u_password.required'     =>  'Vui lòng nhập mật khẩu',
        ];
    }
}
