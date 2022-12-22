<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends FrontendController
{
    public function index()
    {
        $abouts = \DB::table('posts_about')->get();
        $hot    = \DB::table('posts_about')->where('po_hot',1)->orderBy('id','DESC')->first();
        return view('frontend.about',compact('abouts','hot'));
    }


    public function about_detail(Request $request,$slug, $id)
    {
        $pattern = '/(?<=-)(\d+)(?>.html)$/i';
        preg_match($pattern, $request->segment(2), $match);
        if (isset($match[1]))
        {
            $id = $match[1];

            $abouts = \DB::table('posts_about')->get();
            $detail = \DB::table('posts_about')->where('id',$id)->first();

            return view('frontend.about_detail',compact('abouts','detail','id'));
        }
    }
}
