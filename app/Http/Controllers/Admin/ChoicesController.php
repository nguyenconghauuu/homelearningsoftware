<?php

namespace App\Http\Controllers\Admin;

use App\Exams;
use App\Questions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChoicesController extends Controller
{
    public function index()
    {
        $exams = \DB::table('exams')->orderBy('id','DESC')->paginate(10);
        return view('admin.choices.index',compact('exams'));
    }

    public function getAdd()
    {
        return view('admin.choices.add');
    }

    public function create(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        $data['created_at'] = $data['updated_at'] = date(now());
        try{
            \DB::table('exams')->insert($data);
            return redirect()->route('choices.index')->with('success','Thêm mới thành công !!! ');
        }catch (\Exception $e)
        {
            return redirect()->route('choices.index')->with('danger','Thêm mới thất bại !!! ');
        }

    }

    public function delete(Request $request, $id)
    {
        $exams = Exams::findOrFail($id);
        $flagCheck = $exams->delete();
        if($flagCheck > 0)
        {
            return redirect()->route('choices.index')->with('success','Xoá thành công !!! ');
        }
        return redirect()->route('choices.index')->with('danger','Xoá thất bại !!! ');
    }


    public function saveListExams(Request $request)
    {
        $check = \DB::table('list_exams')->where('le_exams_id',$request->id)->count();
        if( $check && $check > 40 )
        {
            return redirect()->route('create.list.exams',$request->id)->with('danger','Thêm mới thất bại , số lượng câu hỏi đã vượt quá so với quy định   !!! ');
        }
        $chuong = $request->chuong;
        $phanloai = $request->phanloai;
        $socauhoi = $request->socauhoi;
        $arrPhanloai = [];
        if($phanloai)
        {
            switch ($phanloai) {
                case '1':
                    $arrPhanloai[] = 1;
                    break;
                case '2':
                    $arrPhanloai[] = 2;
                    break;   
                default:
                    $arrPhanloai = [3,4];
                    break;
            }
        }
        $quers = Questions::orderByRaw('RAND()')
            ->where('ps_category_post_id',$chuong)
            ->whereIn('qs_level',$arrPhanloai)
            ->take($socauhoi)
            ->get();
        foreach ($quers as $key => $value) {
            $data[] = [
                'le_question_id' => $value->id,
                'le_exams_id'    => $request->id
            ];
        }
        if(count($data) < $socauhoi)
        {
            return redirect()->route('create.list.exams',$request->id)->with('danger','Thêm mới thất bại , số lượng câu hỏi không đủ điều kiện  !!! ');
        }
        try{
            \DB::table('list_exams')->insert($data);
            return redirect()->route('choices.index')->with('success','Thêm mới thành công !!! ');
        }catch (\Exception $e)
        {
            return redirect()->route('choices.index')->with('danger','Thêm mới thất bại !!! ');
        }
    }

    public function listExams(Request $request)
    {
        $idExams = $request->id;
        $infoEx = Exams::findOrFail($idExams);

        $listExams  = Questions::with([
            'exams' => function($q)
            {
                $q->select('eu_exam_id','eu_question_id');
            }
        ])->whereHas('exams',function($q) use ($idExams)
        {
            $q->where('eu_exam_id',$idExams)->get();
        })->get();

        return view('admin.choices.list-exams',compact('listExams','infoEx'));

    }
}
