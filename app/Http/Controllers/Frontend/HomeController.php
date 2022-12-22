<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\CategoryPosts;

class HomeController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $cateModel = new CategoryPosts();
        $categorys = DB::table('categoryposts')->limit(10)->get();
//        dd($categorys);
        $sortCategory = array();
        // gọi hàm đệ quy sắp xếp lai danh mục theo thứ tự
        $cateModel->recursive($categorys, $parent = 0 , $level = 1, $sortCategory);

        return view('frontend.home',compact('sortCategory','categorys'));
    }

    public function indexV2()
    {
        $cateModel = new CategoryPosts();
        $categorys = DB::table('categoryposts')->limit(10)->get();
        $sortCategory = array();
        // gọi hàm đệ quy sắp xếp lai danh mục theo thứ tự
        $cateModel->recursive($categorys, $parent = 0 , $level = 1, $sortCategory);

        return view('frontend.home_v2',compact('sortCategory','categorys'));
    }

    public function searchTypehead(Request $request)
    {
        $posts = DB::table('categoryposts')->select('id','cpo_name','cpo_slug','cpo_content');
        $query = $request->input('k');
        if($query)
        {
            $posts = $posts->where("cpo_name","LIKE","%{$query}%")->limit(10)->orderBy('id','DESC')->get();
        }else
        {
            $posts = $posts->limit(10)->orderBy('id','DESC')->get();
        }

        return view('frontend.search', compact('posts'));
    }
}
