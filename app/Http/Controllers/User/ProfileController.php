<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Frontend\FrontendController;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends FrontendController
{
    public function index()
    {
        $idUser = \Auth::guard('web')->user()->id;
        $user = User::find($idUser);

        $viewData = [
            'user' => $user
        ];
        return view('accounts.profile', $viewData);
    }

    public function updateProfile(Request $request)
    {
        $idUser = \Auth::guard('web')->user()->id;
        $user = User::find($idUser);
        $user->fill($request->except('_token'))->save();
        return redirect()->back();
    }

    public function getPassword()
    {
        return view('accounts.password');
    }

    public function savePassword(Request $request)
    {
        $idUser = \Auth::guard('web')->user()->id;
        $user = User::find($idUser);

        $password = $request->password_old;
        if(\Hash::check($password, $user->u_password)) {
            $user->u_password = bcrypt($request->password);
            $user->save();
            return  redirect()->to('/');
        }

        return  redirect()->back();
    }
}
