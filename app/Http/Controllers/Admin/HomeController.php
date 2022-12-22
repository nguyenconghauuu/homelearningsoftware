<?php

namespace App\Http\Controllers\Admin;

use App\CategoryPosts;
use App\Posts;
use App\Questions;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::count();
        $questions = Questions::count();
        $category = CategoryPosts::count();

        $viewData = [
            'totalUser' => $user,
            'totalQuestions' => $questions,
            'totalCategory' => $category,
        ];

        return view('admin.home.index', $viewData);
    }
}
