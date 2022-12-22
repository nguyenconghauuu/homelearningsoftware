<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use View;
class FrontendController extends Controller
{
    public function __construct()
    {
        // lay danh muc cap 1
        $categoryLevel1 = DB::table('categoryposts')->where('cpo_parent_id',0)->orderBy('id','ASC')->get();
        View::share('categoryLevel1', $categoryLevel1);
    }
}
