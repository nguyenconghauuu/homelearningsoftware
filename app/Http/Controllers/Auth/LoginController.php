<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\FrontendController;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends FrontendController
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        parent::__construct();
        // $this->middleware('guest')->except('logout');
        // $this->middleware('guest:web');
    }

    public function getLogin()
    {
        // lay danh muc cap 1
        $categoryLevel1 = \DB::table('categoryposts')->where('cpo_parent_id',0)->orderBy('id','ASC')->get();
        \View::share('categoryLevel1', $categoryLevel1);
        return view('accounts.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request,$this->rule(),$this->messages());

        if (Auth::guard('web')->attempt(['u_email' => $request->u_email,'u_password' => $request->u_password], $request->remember))
        {
            return redirect()->intended(route('home'));
        }
        return redirect()->back()->withInput($request->only('u_email','u_password'));
    }
    /**
     * dieu kien dang nhap
     */
    public function rule()
    {
        return [
            'u_email'     =>  'required|email|max:255',
            'u_password'  =>  'required'
//            'u_password'  =>  'required|regex:/^[a-z0-9A-Z_-]{6,100}$/'
        ];
    }
    /**
     * custome message errors
     */
    public function messages()
    {
        return [
            'u_email.required'        =>  'Vui lòng nhập email',
            'u_email.email'           =>  'Email chưa xác nhận',
            'u_email.max'             =>  'Địa chỉ email quá dài',
            'u_password.required'     =>  'Vui lòng nhập mật khẩu',
            'u_password.regex'        =>  'Mật khẩu chứa ký tự đặc biệt'
        ];
    }
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }

    public function forgotPassword()
    {
        return view('accounts.forgot_password');
    }

    public function postForgotPassword(Request $request)
    {
        $user = User::where('u_email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->with('message',' Không tồn tại tài khoản');
        } else {

            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 10; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }

            $user->code = $randomString;
            $user->save();

            $data = [
                'user' => $user
            ];

            \Mail::send('email.change_pass', $data, function ($m) use ($user) {
                $m->from('hello@app.com', 'homelearningsoftware');
                $m->to($user->u_email, $user->u_name)->subject('Quên mật khẩu!');
            });

            return redirect()->route('get.change_password')->with('message','Mã xác nhận đã gủi tới email của bạn');
        }
    }

    public function changePass(Request $request)
    {
        return view('accounts.change_pass');
    }

    public function saveChangePass(Request $request)
    {
        $user = User::where('code', $request->code)->first();
        if (!$user) {
            return redirect()->back()->with('message','Mã xác nhận không tồn tại');
        }

        $user->u_password = bcrypt($request->password);
        $user->code = null;
        $user->save();
        return redirect()->route('get.dangky.user')->with('message','Cập nhật thành công, mời bạn đăng nhập');
    }
}
