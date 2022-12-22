<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Admins;
use DB;
class ProfilesAdminController extends Controller
{
	public function getIdAdmin()
	{
		if( Auth::guard('admins')->check())
		{
			return   Auth::guard('admins')->user()->id;
		}
		return 0;	
	}
    public function index()
    {
    	$id_admin = $this->getIdAdmin();
    	$profile_admin = Admins::findOrFail($id_admin);
    	return view('admin.profiles.index',compact('profile_admin'));
    }
    public function saveProfile(Request $request)
    {
    	$id_admin = $this->getIdAdmin();
    	$data = $request->all();
    	unset($data['_token']);
    	$profile_admin = Admins::findOrFail($id_admin);
    	
    	if ($request->hasFile('avatar'))
        {
            $info = uploadImg('avatar');
            if($info['code'] == 1)
            {
                $data['avatar'] = $info['name'];
                move_uploaded_file($_FILES['avatar']['tmp_name'], public_path() . '/uploads/' . $info['name']);
            }
        }

        $check = DB::table('admins')->where('id',$id_admin)->update($data);
        if( $check )
        {
            return redirect()->route('admin.profiles.index')->with('success','Cập nhật thành công ');
        }
        return redirect()->route('admin.profiles.index');
    }
}
