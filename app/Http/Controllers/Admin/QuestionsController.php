<?php

namespace App\Http\Controllers\Admin;

use App\CategoryPosts;
use App\Http\Requests\QuestionsRequest;
use App\Posts;
use App\Questions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class QuestionsController extends Controller
{
    public function index(Request $request)
    {
        $cateModel = new CategoryPosts();
        $categoryPost = DB::table('categoryposts')->get();

        // gọi hàm đệ quy sắp xếp lai danh mục theo thứ tự
        $cateModel->recursive($categoryPost, $parent = 0 , $level = 1, $sortCategoryPost);
        if($sortCategoryPost === null) $sortCategoryPost = [];

        $questions = DB::table('questions')
            ->leftJoin('categoryposts', 'categoryposts.id', '=', 'questions.ps_category_post_id')
            ->select('questions.*','cpo_name');
        if($request->categorypost)
        {
            $questions = $questions->where('ps_category_post_id',$request->categorypost);
            $finter['ps_category_post_id'] = $request->categorypost;
        }

        if($request->title)
        {
            $questions->where("qs_name","like","%".$request->title."%");
            $finter['title'] = $request->title;
        }
        $questions = $questions->paginate(20);
        $finter = [];
        $viewData = [
            'questions'        => $questions,
            'finter'           => $finter,
            'sortCategoryPost' => $sortCategoryPost ?? []
        ];
        return view('admin.questions.index',$viewData);
    }
    public function getAdd()
    {
        /**
         *  khởi tạo model Categorys
         */
        $cateModel = new CategoryPosts();
        $categoryPost = DB::table('categoryposts')->get();

        // gọi hàm đệ quy sắp xếp lai danh mục theo thứ tự
        $cateModel->recursive($categoryPost, $parent = 0 , $level = 1, $sortCategoryPost);
        $viewData = [
            'sortCategoryPost' => $sortCategoryPost ?? []
        ];
        return view('admin.questions.add',$viewData);
    }
    public function create(QuestionsRequest $request)
    {
        $data = $request->all();

        $data['created_at'] = $data['updated_at'] = date(now());
        unset($data['_token']);
        if ($request->hasFile('qs_thunbar'))
        {
            $info = uploadImg('qs_thunbar');
            if($info['code'] == 1)
            {
                $data['qs_thunbar'] = $info['name'];
                move_uploaded_file($_FILES['qs_thunbar']['tmp_name'], public_path() . '/uploads/questions/' . $info['name']);
            }
        }
        $id = Questions::insert($data);
        if($id > 0)
        {
            return redirect()->route('admin.questions.index')->with('success',' Thêm mới thành công !!! ');
        }
        return redirect()->route('admin.questions.index')->with('danger',' Thêm mới thất bại !!! ');
    }

    public function getEdit($id)
    {
        $question = Questions::findOrFail($id);
        $cateModel = new CategoryPosts();
        $categoryPost = DB::table('categoryposts')->get();

        // gọi hàm đệ quy sắp xếp lai danh mục theo thứ tự
        $cateModel->recursive($categoryPost, $parent = 0 , $level = 1, $sortCategoryPost);

        return view('admin.questions.edit',compact('question','sortCategoryPost'));
    }

    public function update(Request $request , $id)
    {
        $data = $request->all();
        unset($data['_token']);
        $data['created_at'] = $data['updated_at'] = date(now());

        if ($request->hasFile('qs_thunbar'))
        {
            $info = uploadImg('qs_thunbar');
            if($info['code'] == 1)
            {
                $data['qs_thunbar'] = $info['name'];
                move_uploaded_file($_FILES['qs_thunbar']['tmp_name'], public_path() . '/uploads/questions/' . $info['name']);
            }
        }

        $id = DB::table('questions')->where('id',$id)->update($data);
        if($id > 0)
        {
            return redirect()->route('admin.questions.index')->with('success',' Câp nhật thành công !!! ');
        }
        return redirect()->route('admin.questions.index')->with('danger',' Câp nhật thất bại !!! ');
    }

    public function delete($id)
    {
        $quest = Questions::findOrFail($id);
        $flagCheck = $quest->delete();
        if($flagCheck > 0)
        {
            return redirect()->route('admin.questions.index')->with('success','Xoá thành công !!! ');
        }
        return redirect()->route('admin.questions.index')->with('danger','Xoá thất bại !!! ');
    }
}
