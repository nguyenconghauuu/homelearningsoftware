<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostsRequest;
use App\PostAbout;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PostAboutController extends Controller
{
    public function index(Request $request)
    {
        $postAbout = DB::table('posts_about')->get();

        $viewData = [
            'postAbout'  => $postAbout
        ];
        return view('admin.post_about.index',$viewData);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * show form thêm mới bài viết
     */
    public function getAdd()
    {
        return view('admin.post_about.add');
    }

    /**
     * @param PostsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * xử lý thêm mới bài viết
     */
    public function createCategory(PostsRequest $request)
    {
        $data = $request->all();
        $data['po_slug'] = str_slug($request->po_title);
        $data['created_at'] = $data['updated_at'] = date(now());
        unset($data['_token']);
        if ($request->hasFile('po_thunbar'))
        {
            $info = uploadImg('po_thunbar');
            if($info['code'] == 1)
            {
                $data['po_thunbar'] = $info['name'];
                move_uploaded_file($_FILES['po_thunbar']['tmp_name'], public_path() . '/uploads/posts/' . $info['name']);
            }
        }

        $id = PostAbout::insert($data);
        if($id > 0)
        {
            return redirect()->route('admin.post.about.index')->with('success',' Thêm mới thành công !!! ');
        }
        return redirect()->route('admin.post.about.index')->with('danger',' Thêm mới thất bại !!! ');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * show form cập nhật bài viết
     */
    public function getEdit($id)
    {
        $post = PostAbout::findOrFail($id);
        return view('admin.post_about.update',compact('post'));
    }

    /**
     * @param PostsRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * cập nhật bài viết
     */
    public function postEdit(PostsRequest $request, $id)
    {
        $data = $request->all();
        $data['po_slug'] = str_slug($request->po_title);
        unset($data['_token']);
        $data['created_at'] = $data['updated_at'] = date(now());
        if ($request->hasFile('po_thunbar'))
        {
            $info = uploadImg('po_thunbar');
            if($info['code'] == 1)
            {
                $data['po_thunbar'] = $info['name'];
                move_uploaded_file($_FILES['po_thunbar']['tmp_name'], public_path() . '/uploads/posts/' . $info['name']);
            }
        }
        $id = DB::table('posts_about')->where('id',$id)->update($data);
        if($id > 0)
        {
            return redirect()->route('admin.post.about.index')->with('success',' Câp nhật thành công !!! ');
        }
        return redirect()->route('admin.post.about.index')->with('danger',' Câp nhật thất bại !!! ');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * xoá bài viết
     */
    public function delete($id)
    {
        $post = PostAbout::findOrFail($id);
        $flagCheck = $post->delete();
        if($flagCheck > 0)
        {
            return redirect()->route('admin.post.about.index')->with('success','Xoá thành công !!! ');
        }
        return redirect()->route('admin.post.about.index')->with('danger','Xoá thất bại !!! ');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectRespons
     * thay đổi trạng thái bài viết
     */
    public function hot($id)
    {
        $post = PostAbout::findOrFail($id);
        $post->po_hot = ! $post->po_hot;
        $post->save();
        return redirect()->route('admin.post.about.index')->with('success','Cập nhật thành công !!! ');
    }
    public function active($id)
    {
        $post = PostAbout::findOrFail($id);
        $post->po_active = ! $post->po_active;
        $post->save();
        return redirect()->route('admin.post.about.index')->with('success','Cập nhật thành công !!! ');
    }

    public function view(Request $request,$id)
    {
        $id = $request->id;
        $post = Posts::findOrFail($id);
        return response()->json(['post' => $post]);
    }
}
