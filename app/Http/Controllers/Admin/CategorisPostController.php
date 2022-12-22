<?php

namespace App\Http\Controllers\Admin;

use App\CategoryPosts;
use App\Http\Requests\CategoryPostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategorisPostController extends Controller
{
    /**
     * hiển thi danh sách danh mục
     */
    public function index(Request $request)
    {
        $cateModel = new CategoryPosts();
        $catePost = DB::table('categoryposts')->whereRaw(1);

        if ($request->title)
            $catePost->where('cpo_name','like','%'.$request->title.'%');

        $catePost =  $catePost->get();

        // gọi hàm đệ quy sắp xếp lai danh mục theo thứ tự
        $cateModel->recursive($catePost, $parent = 0 , $level = 1, $sortCategoryPost);
        return view('admin.categorypost.index',compact('sortCategoryPost'));
    }

    /**
     * show ra form thêm mới danh mục
     */
    public function getAdd()
    {
        /**
         *  khởi tạo model Categorys
         */
        $cateModel = new CategoryPosts();
        $categorys = DB::table('categoryposts')->get();

        // gọi hàm đệ quy sắp xếp lai danh mục theo thứ tự
        $cateModel->recursive($categorys, $parent = 0 , $level = 1, $sortCategory);
        return view('admin.categorypost.add',compact('sortCategory'));
    }

    /**
     * @param CategorysRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * xử lý thêm mới danh mục
     */
    public function createCategory(CategoryPostRequest $request)
    {

        $data = $request->all();
        $data['cpo_slug'] = str_slug($request->cpo_name);
        unset($data['_token']);

        $id = CategoryPosts::insert($data);
        if($id > 0)
        {
            return redirect()->route('admin.categorypost.index')->with('success',' Thêm mới thành công !!! ');
        }
        return redirect()->route('admin.categorypost.index')->with('danger',' Thêm mới thất bại !!! ');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *  Show form câp nhật danh mục
     */

    public function getEdit($id)
    {
        $category = CategoryPosts::findOrFail($id);
        $cateModel = new CategoryPosts();
        $categorys = DB::table('categoryposts')->get();

        // gọi hàm đệ quy sắp xếp lai danh mục theo thứ tự
        $cateModel->recursive($categorys, $parent = 0 , $level = 1, $sortCategory);
        return view('admin.categorypost.update',compact('category','sortCategory'));
    }

    /**
     * @param CategorysRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * Cập nhật danh mục
     */
    public function postEdit(CategoryPostRequest $request, $id)
    {
        $data = $request->all();
        $data['cpo_slug'] = str_slug($request->cpo_name);
        unset($data['_token']);

        $id = DB::table('categoryposts')->where('id',$id)->update($data);
        if($id > 0)
        {
            return redirect()->route('admin.categorypost.index')->with('success',' Câp nhật thành công !!! ');
        }
        return redirect()->route('admin.categorypost.index')->with('danger',' Câp nhật thất bại !!! ');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * Xoá danh mục
     */
    public function delete($id)
    {
        $categorys = CategoryPosts::findOrFail($id);
        $flagCheck = $categorys->delete();
        if($flagCheck > 0)
        {
            return redirect()->route('admin.categorypost.index')->with('success','Xoá thành công !!! ');
        }
        return redirect()->route('admin.categorypost.index')->with('danger','Xoá thất bại !!! ');
    }
}
