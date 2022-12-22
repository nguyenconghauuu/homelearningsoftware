<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\CategoryPosts;
use App\Posts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PostsDetailController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function detailPost(Request $request)
    {
        // $cateModel = new CategoryPosts();
        $idPost = (int)$request->id;

        $postDetail = Posts::findOrFail($idPost);
        // lay danh muc cua post

        $idCate            = (int)$request->idcate;
        $categoy           = CategoryPosts::findOrFail($idCate);
        $categoryChildrens = CategoryPosts::where('cpo_parent_id', $idCate)->get();
        if ($categoy && $categoy->cpo_parent_id) {
            $categoyParent = CategoryPosts::where('id', $categoy->cpo_parent_id)->first();
            if ($categoyParent) {
                $categoryChildrens = CategoryPosts::where('cpo_parent_id', $categoyParent->id)->get();
            }
        }

        $comments = DB::table('comments')->where('cmt_post_id', $idPost)->orderBy('id', 'DESC')->get();
        $viewData = [
            'postDetail'        => $postDetail,
            'CategoryChildrens' => $categoryChildrens,
            'comments'          => $comments,
            'categoy'           => $categoy,
            'idCate'            => $idCate
        ];

        return view('frontend.detail-post', $viewData);
//        return view('frontend.detail-post',$viewData);
    }

    public function saveComment(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        $data['cmt_post_id'] = $request->id;
        $data['created_at']  = $data['updated_at'] = date(now());
        $user                = \Auth::guard('web')->check();
        if ($user) {
            $data['cmt_name']  = \Auth::guard('web')->user()->u_name;
            $data['cmt_email'] = \Auth::guard('web')->user()->u_email;
        }

        try {

            $idcomment = DB::table('comments')->insert($data);
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    // show cau hoi ajax cua post
    public function getQuestionAjax(Request $request)
    {
        $id        = $request->idpost;
        $questions = DB::table('questions')->where('qs_post_id', $id)->limit(5)->get();
        return response()->json(['questions' => $questions]);
    }

    public function getQuestionAjaxPost(Request $request)
    {
        $id        = $request->idpost;
        $questions = DB::table('questions')
            ->where('ps_category_post_id', $id)
            ->where('qs_post_id', 0)
            ->limit(5)->get();
        return response()->json(['questions' => $questions]);
    }

    public function thongtin($id, $slug)
    {

        $postAbout = DB::table('posts_about')->orderBy('id', 'DESC')->get();

        $post = DB::table('posts_about')->where('id', $id)->first();
        return view('frontend.thongtin', compact('post', 'postAbout'));
    }
}
