<?php

namespace App\Http\Controllers\AuthAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AuthController extends Controller
{
    public function logoutAdmin(Request $request)
    {
    	
       if(Auth::guard('admins')->check())
   		{
   			Auth::guard('admins')->logout();
            $request->session()->flush();
            $request->session()->regenerate();
            return redirect()->route( 'admin.login');
   		}
    }
}
