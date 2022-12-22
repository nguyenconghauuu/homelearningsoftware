<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Requests\UsersRequest;
use Hash;
use App\User;
class UsersController extends Controller
{
    public function index(Request $request)
    {
        $finter = [];
        $users = DB::table('users');
        if($request->keyword)
        {
            $users->orWhere("u_name","like","%".$request->keyword."%");
            $users->orWhere("u_email","like","%".$request->keyword."%");
            $users->orWhere("u_address","like","%".$request->keyword."%");
            $finter['keyword'] = $request->keyword;
        }

        // tim kiem theo user dc active 
        if($request->u_active)
        {
            $u_active = $request->u_active == 2 ? 0 : 1;
            $users->where("u_active",$u_active);
            $finter['u_active'] = $request->u_active;
        }
        // tim kiem user online 
        if($request->u_online)
        {
            $u_online = $request->u_online == 2 ? 0 : 1;
            $users->where("u_online",$u_online);
            $finter['u_online'] = $request->u_online;
        }
        // loc theo ngay thang 
        if($request->date)
        {
            $date = $request->date;
            $users->whereDate('created_at','=',$date);
    
        }
        // loc thoe ngay tuan thang nam
        if($request->finddate)
        {
            $finddate = $request->finddate;
            switch ($finddate) {
                   case 'day':
                        $users->whereDay('created_at','=',date('d'));
                        break;
                   case 'week':

                        break;
                   case 'month':
                        $users->whereMonth('created_at','=',date('m'));
                        break;
                   case 'year':
                        $users->whereYear('created_at','=',date('Y'));
                        break;
               }   
        }
        // phan trang
        if($request->paginate)
        {
            $users = $users->paginate($request->paginate);
        }
        else
        {
            $users = $users->paginate(5);
        }
    
        return view('admin.users.index',compact('users','finter'));
    }
    public function getAdd()
    {
    	return view('admin.users.add');
    }	
    public function createUser(UsersRequest $request)
    {
    
    	$data = $request->all();
    	unset($data['_token']);
    	unset($data['u_repassword']);
    	$data['u_password'] = Hash::make($request->u_password);
    	$data['created_at'] = $data['updated_at'] = date(now());
        if ($request->hasFile('u_avatar'))
        {
            $info = uploadImg('u_avatar');
            if($info['code'] == 1)
            {
                $data['u_avatar'] = $info['name'];
                move_uploaded_file($_FILES['u_avatar']['tmp_name'], public_path() . '/uploads/users/' . $info['name']);
            }
        }
    
    	$id = DB::table('users')->insert($data);
    	if($id > 0)
        {
            return redirect()->route('admin.users.index')->with('success',' Thêm mới thành công !!! ');
        }
        return redirect()->route('admin.users.index')->with('danger',' Thêm mới thất bại !!! ');
    }

    public function getEdit($id)
    {
    	$user = User::findOrFail($id);
        return view('admin.users.update',compact('user'));
    }

    public function postEdit( UsersRequest $request , $id )
    {
 
    	$data = $request->all();
    	unset($data['_token']);
        unset($data['u_repassword']);
        $user = User::findOrFail($id);
        if($user->u_email != $request->u_email)
        {
            $check = DB::table('users')->where('u_email',$request->u_email)->first();
            if($check) 
            {
                return redirect()->route('admin.users.edit',$id)->with('danger',' Email đã tồn tại ');
            }
        }else 
        {
            unset($data['u_email']);
        }
        if($request->u_password)
        {
            $data['u_password'] = Hash::make($request->u_password);
        }

        if ($request->hasFile('u_avatar'))
        {
            $info = uploadImg('u_avatar');
            if($info['code'] == 1)
            {
                $data['u_avatar'] = $info['name'];
                move_uploaded_file($_FILES['u_avatar']['tmp_name'], public_path() . '/uploads/users/' . $info['name']);
            }
        }
    	
    	$data['updated_at'] = date(now());
    	$id = DB::table('users')->where('id',$id)->update($data);
    	if($id > 0)
        {
            return redirect()->route('admin.users.index')->with('success',' Cập nhật thành công !!! ');
        }
        return redirect()->route('admin.users.index')->with('danger',' Cập nhật thất bại !!! ');
    }
    public function active($id)
    {
        $user = User::findOrFail($id);
        $user->u_active = ! $user->u_active;
        $user->save();
        return redirect()->route('admin.users.index')->with('success','Cập nhật thành công !!! ');
    }

    public function delete($id)
    {
        $users = User::findOrFail($id);
        $flagCheck = $users->delete();
        if($flagCheck > 0)
        {
            return redirect()->route('admin.users.index')->with('success','Xoá thành công !!! ');
        }
        return redirect()->route('admin.users.index')->with('danger','Xoá thất bại !!! ');
    }

    public function xemDiem($id)
    {
        $diem = DB::table('exam_result')
            ->leftJoin('users','users.id','=','exam_result.er_user_id')
            ->leftJoin('exams','exams.id','=','exam_result.er_exam_id')
            ->leftJoin('categoryposts','categoryposts.id','=','exam_result.category_id')
            ->where('er_user_id',$id)->get();

        return view('admin.users.ket-qua-thi',compact('diem'));
    }
}
