<?php

namespace App\Http\Controllers\Admin;


use App\CategoryPosts;
use App\Http\Requests\PostsRequest;
use App\Posts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Units\FunctionCheck;
class PostsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * show danh sách bài viết
     */
    public function index(Request $request)
    {
        /**
         *  khởi tạo model Categorys
         */

        // $cateModel = new CategoryPosts();
        // $categorys = DB::table('categorys')->get();
        $sortCategory = [];
        // gọi hàm đệ quy sắp xếp lai danh mục theo thứ tự
//         $cateModel->recursive($categorys, $parent = 0 , $level = 1, $sortCategory);

        // danh sach bai viet
        $posts = DB::table('posts')
                ->leftJoin('admins', 'admins.id', '=', 'posts.po_admin_id')
                ->leftJoin('categoryposts', 'categoryposts.id', '=', 'posts.po_category_post_id')
                ->select('admins.name','posts.*','categoryposts.cpo_name as name_category');
        $finter = [];
        // tim kiem theo title
        if($request->title)
        {
            $posts->where("po_title","like","%".$request->title."%");
            $finter['title'] = $request->title;
        }

        // tim kiem theo danh muc
        if($request->category_id)
        {
            $posts->where("category_id",$request->category_id);
            $finter['category_id'] = $request->category_id;
        }
        // tim kiem theo bai viet dc active
        if($request->active)
        {
            $active = $request->active == 2 ? 0 : 1;
            $posts->where("po_active",$active);
            $finter['active'] = $request->active;
        }
        // tim kiem theo bai viet hot
        if($request->hot)
        {
            $hot = $request->hot == 2 ? 0 : 1;
            $posts->where("po_hot",$hot);
            $finter['hot'] = $request->hot;
        }
        // phan trang
        if($request->paginate)
        {
            $posts = $posts->paginate($request->paginate);
        }
        else
        {
            $posts = $posts->paginate(5);
        }

        return view('admin.posts.index',compact('posts','sortCategory','finter'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * show form thêm mới bài viết
     */
    public function getAdd()
    {

        /**
         *  khởi tạo model Categorys
         */
        $cateModel = new CategoryPosts();
        $categoryPost = DB::table('categoryposts')->get();

        // gọi hàm đệ quy sắp xếp lai danh mục theo thứ tự
        $cateModel->recursive($categoryPost, $parent = 0 , $level = 1, $sortCategoryPost);

        return view('admin.posts.add',compact('sortCategoryPost'));
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
        if(FunctionCheck::checkLoginAdmin())
        {
            $idadmin = FunctionCheck::getInfoAdmin()->id;
            $data['po_admin_id'] = $idadmin;
        }
        $id = Posts::insert($data);
        if($id > 0)
        {
            return redirect()->route('admin.posts.index')->with('success',' Thêm mới thành công !!! ');
        }
        return redirect()->route('admin.posts.index')->with('danger',' Thêm mới thất bại !!! ');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * show form cập nhật bài viết
     */
    public function getEdit($id)
    {
        $post = Posts::findOrFail($id);
        $cateModel = new CategoryPosts();
        $categoryPost = DB::table('categoryposts')->get();

        // gọi hàm đệ quy sắp xếp lai danh mục theo thứ tự
        $cateModel->recursive($categoryPost, $parent = 0 , $level = 1, $sortCategoryPost);
        return view('admin.posts.update',compact('post','sortCategoryPost'));
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
        $id = DB::table('posts')->where('id',$id)->update($data);
        if($id > 0)
        {
            return redirect()->route('admin.posts.index')->with('success',' Câp nhật thành công !!! ');
        }
        return redirect()->route('admin.posts.index')->with('danger',' Câp nhật thất bại !!! ');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * xoá bài viết
     */
    public function delete($id)
    {
        $post = Posts::findOrFail($id);
        $flagCheck = $post->delete();
        if($flagCheck > 0)
        {
            return redirect()->route('admin.posts.index')->with('success','Xoá thành công !!! ');
        }
        return redirect()->route('admin.posts.index')->with('danger','Xoá thất bại !!! ');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectRespons
     * thay đổi trạng thái bài viết
     */
    public function hot($id)
    {
        $post = Posts::findOrFail($id);
        $post->po_hot = ! $post->po_hot;
        $post->save();
        return redirect()->route('admin.posts.index')->with('success','Cập nhật thành công !!! ');
    }
    public function active($id)
    {
        $post = Posts::findOrFail($id);
        $post->po_active = ! $post->po_active;
        $post->save();
        return redirect()->route('admin.posts.index')->with('success','Cập nhật thành công !!! ');
    }

    public function view(Request $request,$id)
    {
        $id = $request->id;
        $post = Posts::findOrFail($id);
        return response()->json(['post' => $post]);
    }
}
