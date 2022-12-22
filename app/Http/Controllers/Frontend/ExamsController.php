<?php

namespace App\Http\Controllers\Frontend;

use App\ExamResult;
use App\Exams_users;
use App\Questions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\CategoryPosts;

class ExamsController extends FrontendController
{
    protected $postAbout;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * show ra  CHAO MUNG BAN DEN VS HE THONG
     * THI THU
     */
    public function index()
    {
        $cateModel    = new CategoryPosts();
        $categorys    = DB::table('categoryposts')->get();
        $sortCategory = array();
        // gọi hàm đệ quy sắp xếp lai danh mục theo thứ tự
        $cateModel->recursive($categorys, $parent = 0, $level = 1, $sortCategory);
        return view('frontend.exams.create', compact('sortCategory'));
    }

    public function getQuiz($idCate)
    {
        $categoy           = CategoryPosts::findOrFail($idCate);
        $categoryChildrens = CategoryPosts::where('cpo_parent_id', $idCate)->get();
        if ($categoy && $categoy->cpo_parent_id) {
            $categoyParent = CategoryPosts::where('id', $categoy->cpo_parent_id)->first();
            if ($categoyParent) {
                $categoryChildrens = CategoryPosts::where('cpo_parent_id', $categoyParent->id)->get();
            }
        }

        $viewData = [
            'CategoryChildrens' => $categoryChildrens,
            'category'          => $categoy,
            'id'                => $idCate,
            'categoyParent'     => $categoyParent ?? []
        ];

        return view('frontend.exams.quiz', $viewData);
    }

    public function postQuiz($idCate)
    {
        $user = Auth::guard('web')->check();
        if (!$user) {
            return redirect()->back()->with('danger', ' Mời bạn đăng nhập để thực hiện chức năng này !');
        }
        $idUser = Auth::guard('web')->user()->id;

        $data_exam = [
            'e_code'      => str_random(10),
            'e_level'     => 1,
            'category_id' => $idCate,
            'e_user_id'   => $idUser,
            'created_at'  => Carbon::now()
        ];
        // đề
        $idExams = \DB::table('exams')->insertGetId($data_exam);

        $questions = $this->createExamsLevel1(20, $idCate);

        if ($questions && $idExams) {
            foreach ($questions as $item) {
                $que            = Questions::find($item->id);
                $data_user_exam = [
                    'eu_exam_id'      => $idExams,
                    'eu_question_id'  => $item->id,
                    'correct_answer'  => $que->qs_answer_true,
                    'selected_answer' => 0
                ];
                DB::table('exams_users')->insert($data_user_exam);
            }
            return redirect()->route('vaothi', [$idUser, $idExams, $idCate]);
        }
    }


    /**
     * vao thi
     */
    public function startExams(Request $request)
    {
        $cateModel    = new CategoryPosts();
        $categorys    = DB::table('categoryposts')->get();
        $sortCategory = array();
        // gọi hàm đệ quy sắp xếp lai danh mục theo thứ tự
        $cateModel->recursive($categorys, $parent = 0, $level = 1, $sortCategory);

        $idExams    = $request->idde;
        $categoryID = $request->categoryID;

        $idQuest = DB::table('exams_users')->where('eu_exam_id', $idExams)->get();
        $cauHoi  = [];
        foreach ($idQuest as $item) {
            $cauHoi[] = DB::table('questions')->where('id', $item->eu_question_id)->first();
        }

        $category          = CategoryPosts::findOrFail($categoryID);
        $CategoryChildrens = CategoryPosts::where('cpo_parent_id', $categoryID)->get();
        if ($category && $category->cpo_parent_id) {
            $categoyParent = CategoryPosts::where('id', $category->cpo_parent_id)->first();
            if ($categoyParent) {
                $CategoryChildrens = CategoryPosts::where('cpo_parent_id', $categoyParent->id)->get();
            }
        }
        $id = $categoryID;
        return view('frontend.exams.start_baithi', compact('cauHoi', 'sortCategory', 'category', 'CategoryChildrens', 'id'));
    }

    /**
     * luu dap an nguoo dung va show lai man hinh
     *  Luu kết quả làm bài của user
     */
    public function saveExams(Request $request)
    {
        $cateModel    = new CategoryPosts();
        $categorys    = DB::table('categoryposts')->get();
        $sortCategory = array();
        // gọi hàm đệ quy sắp xếp lai danh mục theo thứ tự
        $cateModel->recursive($categorys, $parent = 0, $level = 1, $sortCategory);

        $data = $request->all();
        unset($data['_token']);
        $cauHoi = [];
        $count  = 0;

        $id_dethi = $request->segment(4);

        foreach ($data as $key => $item) {
            $idQuest    = (int)str_replace('dapan-', '', $key);
            $checkQuest = Questions::find($idQuest);

            if ($checkQuest->qs_answer_true == $item) {
                $cauHoi[$checkQuest->id] = [
                    'check' => true,
                    'dapan' => $item
                ];
                $count++;
            } else {
                $cauHoi[$checkQuest->id] = [
                    'check' => false,
                    'dapan' => $item
                ];
            }
        }

        $ketqua = [];
        // lay danh sach cau hoi cua de ti
        $list_id_exam = DB::table('exams_users')->where('eu_exam_id', $id_dethi)->get();

        foreach ($list_id_exam as $item) {
            if (array_key_exists($item->eu_question_id, $cauHoi)) {
                $ketquan[] = [
                    'data'  => DB::table('questions')->where('id', $item->eu_question_id)->first(),
                    'dapan' => $cauHoi[$item->eu_question_id]
                ];
            } else {
                $ketquan[] = [
                    'data'  => DB::table('questions')->where('id', $item->eu_question_id)->first(),
                    'dapan' => [
                        'check' => 'none',
                        'dapan' => 'none'
                    ]
                ];
            }

            \DB::table('exams_users')->where([
                'eu_question_id' => $item->eu_question_id,
                'eu_exam_id'     => $id_dethi,
            ])->update([
                'selected_answer' => $cauHoi[$item->eu_question_id]['dapan'] ?? null
            ]);
        }

        $idCate      = $request->segment(5);
        $socauchulam = 20 - count($data);

        $idExamsResult = DB::table('exam_result')->insertGetId([
            'er_user_id'  => Auth::guard('web')->user()->id,
            'er_point'    => $count,
            'category_id' => $idCate,
            'did'         => count($data),
            'er_exam_id'  => $id_dethi,
            'wrong'       => count($data) - $count,
            'correct'     => $count,
            'do_not'      => 20 - count($data),
            'created_at'  => Carbon::now()
        ]);

        $idUser  = Auth::guard('web')->user()->id;
        $idExams = $request->segment(4);

        return redirect()->route('get.kq.quiz', [$idUser, $idExams, $idCate, 'view' => 'preview']);
    }

    public function getListQuiz()
    {
        $cateModel    = new CategoryPosts();
        $categorys    = \Illuminate\Support\Facades\DB::table('categoryposts')->get();
        $sortCategory = array();
        // gọi hàm đệ quy sắp xếp lai danh mục theo thứ tự
        $cateModel->recursive($categorys, $parent = 0, $level = 1, $sortCategory);
        $viewData = [
            'categorys' => $categorys
        ];

        return view('frontend.list_quiz', $viewData);
    }

    public function getListQuizByCategory(Request $request, $categoryID)
    {
        $categoy        = CategoryPosts::findOrFail($categoryID);
        $categoryParent = CategoryPosts::where('id', $categoy->cpo_parent_id)->first();

        $categoryChildrens = CategoryPosts::where('cpo_parent_id', $categoryParent->id)->get();

        $viewData      = [
            'categoryParent'    => $categoryParent,
            'categoy'           => $categoy,
            'CategoryChildrens' => $categoryChildrens,
            'id_parent'         => $categoryParent->id
        ];
        return view('frontend.list_quiz', $viewData);
    }

    public function listKQ()
    {
        $idUser = Auth::guard('web')->user()->id;
        $lists  = ExamResult::with('user:id,u_name', 'category:id,cpo_name')
            ->withCount('exams_users')
            ->where('er_user_id', $idUser)
            ->orderByDesc('id')->get();

        $viewData = [
            'lists' => $lists
        ];

        return view('frontend.exams.list_kq', $viewData);
    }

    public function listKQQuiz($id)
    {
        $examResultItem = ExamResult::find($id);
        if (!$examResultItem) return abort(404);

        $viewData = [
            'examResultItem' => $examResultItem
        ];

        return view('frontend.exams.list_kq_item', $viewData);
    }

    public function kqExams($idUser, $idExams, $idCate)
    {
        $category          = CategoryPosts::findOrFail($idCate);
        $CategoryChildrens = CategoryPosts::where('cpo_parent_id', $idCate)->get();
        if ($category && $category->cpo_parent_id) {
            $categoyParent = CategoryPosts::where('id', $category->cpo_parent_id)->first();
            if ($categoyParent) {
                $CategoryChildrens = CategoryPosts::where('cpo_parent_id', $categoyParent->id)->get();
            }
        }

        $exams_users = Exams_users::with('question')->where('eu_exam_id', $idExams)->get();
        $examResult  = ExamResult::where('er_exam_id', $idExams)->orderByDesc('id')->first();
        $viewData    = [
            'CategoryChildrens' => $CategoryChildrens,
            'category'          => $category,
            'id'                => $idCate,
            'categoyParent'     => $categoyParent ?? [],
            'exams_users'       => $exams_users,
            'examResultItem'        => $examResult,
        ];

        return view('frontend.exams.kq', $viewData);
    }

    /**
     * tao cau hoi cap 1
     * @return array
     */
    public function createExamsLevel1($limit, $categoryId)
    {
        return Questions::where('ps_category_post_id', $categoryId)->limit($limit)->get();
    }
}


