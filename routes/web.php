<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/**
 * route   xử lý cho admin
 */
Route::group(['prefix' => '/admins','middleware' => 'admins'], function() {
    Route::get('/',['as' => 'admins.home.index','uses' => 'Admin\HomeController@index']);

    // xử lý danh mục bài viết 
     Route::group(['prefix' => '/category-post'], function () {
        Route::get('/', ['as' => 'admin.categorypost.index','uses' => 'Admin\CategorisPostController@index']);
        Route::get('/add', ['as' => 'admin.categorypost.add','uses' => 'Admin\CategorisPostController@getAdd']);
        Route::post('/add', ['uses' => 'Admin\CategorisPostController@createCategory']);
        Route::get('/{id}/edit',['as' => 'admin.categorypost.edit','uses' => 'Admin\CategorisPostController@getEdit']);
        Route::post('/{id}/edit',['uses' => 'Admin\CategorisPostController@postEdit']);
        Route::get('/{id}/delete',['as' => 'admin.categorypost.delete','uses' => 'Admin\CategorisPostController@delete']);
        Route::get('/{id}/hot',['as' => 'admin.categorypost.hot','uses' => 'Admin\CategorisPostController@hot']);
    });

    // quan ly thành viên 
    Route::group(['prefix' => 'users'], function() {
        Route::get('/', ['as' => 'admin.users.index','uses' => 'Admin\UsersController@index']);
        Route::get('/add', ['as' => 'admin.users.add','uses' => 'Admin\UsersController@getAdd']);
        Route::post('/add', ['uses' => 'Admin\UsersController@createUser']);
        Route::get('/{id}/edit', ['as' => 'admin.users.edit','uses' => 'Admin\UsersController@getEdit']);
        Route::post('/{id}/edit', ['uses' => 'Admin\UsersController@postEdit']);
        Route::get('/{id}/delete',['as' => 'admin.users.delete','uses' => 'Admin\UsersController@delete']);
        Route::get('/{id}/active',['as' => 'admin.users.active','uses' => 'Admin\UsersController@active']);

        Route::get('/{id}/xem-diem',['as' => 'admin.users.viewdiem','uses' => 'Admin\UsersController@xemDiem']);
    });
    // quan ly trac nghiem
    Route::group(['prefix' => 'choices'], function (){
        Route::get('/','Admin\ChoicesController@index')->name('choices.index');
        Route::get('/add','Admin\ChoicesController@getAdd')->name('choices.add');
        Route::post('/add','Admin\ChoicesController@create')->name('choices.create');
        Route::get('/{id}/delete','Admin\ChoicesController@delete')->name('choices.delete');

        // tao random cau hoi

        Route::get('/{id}/create-list-exams','Admin\ChoicesController@createListExams')->name('create.list.exams');
        Route::post('/{id}/create-list-exams','Admin\ChoicesController@saveListExams')->name('save.list.exams');
        Route::get('/{id}/list-exams','Admin\ChoicesController@listExams')->name('list.exams');

    });

    /**
     * profiles admins  
     */
    Route::group(['prefix' => 'profiles'], function() {
        Route::get('/', ['as' => 'admin.profiles.index','uses' => 'Admin\ProfilesAdminController@index']);
        Route::post('/',['uses' => 'Admin\ProfilesAdminController@saveProfile']);
    });

    // cau hoi
    Route::group(['prefix' => 'questions'], function (){
        Route::get('/','Admin\QuestionsController@index')->name('admin.questions.index');
        Route::get('/add','Admin\QuestionsController@getAdd')->name('admin.questions.add');
        Route::post('/add','Admin\QuestionsController@create')->name('admin.questions.create');
        Route::get('/{id}/edit','Admin\QuestionsController@getEdit')->name('admin.questions.edit');
        Route::post('/{id}/edit','Admin\QuestionsController@update')->name('admin.questions.update');
        Route::get('/{id}/delete','Admin\QuestionsController@delete')->name('admin.questions.delete');

        //ajax
        Route::post('/loadPost','Admin\QuestionsController@loadPost')->name('admin.questions.loadpost');
    });
});
//Auth::routes();
Route::get('/home', 'Frontend\HomeController@index')->name('home');

/**
 *  auth admin 
 */
Route::group(['prefix' =>'authenticate'], function() {
    Route::get('/login',['as' => 'admin.login','uses' => 'AuthAdmin\LoginController@getLogin']);
    Route::post('/login',['as' => 'admin.postlogin','uses' =>  'AuthAdmin\LoginController@postLogin']);
    Route::get('/register','AuthAdmin\AuthController@getRegister');
    Route::post('/register','AuthAdmin\AuthController@postRegister');
    Route::get('/logout-admin',['as' => 'logout.admins','uses' => 'AuthAdmin\AuthController@logoutAdmin']);
});

/**
 * login frontend
 */

Route::get('/','Frontend\HomeController@index')->name('home');
Route::get('/v2','Frontend\HomeController@indexV2')->name('home.v2');

Route::get('/dang-nhap','Auth\LoginController@getLogin')->name('get.dangky.user');
Route::post('/dang-nhap','Auth\LoginController@postLogin')->name('post_login');

Route::get('/logout','Auth\LoginController@logout')->name('logout_user');
Route::get('/quen-mat-khau','Auth\LoginController@forgotPassword')->name('get.forgot_password');
Route::post('/quen-mat-khau','Auth\LoginController@postForgotPassword');

Route::get('change-pass','Auth\LoginController@changePass')->name('get.change_password');
Route::post('change-pass','Auth\LoginController@saveChangePass');

Route::get('/dang-ky','Auth\RegisterController@getRegister')->name('dangky.user');
Route::post('/dang-ky','Auth\RegisterController@postRegister')->name('postRegister');

Route::group(['prefix' => 'danh-muc'],function(){

    Route::get('/gioi-thieu/{slug}/{id}','Frontend\CategorysController@showCategoryCap2')->name('show-category-cap2');

    //Frontend
    Route::get('/{slug}/{id}','Frontend\CategorysController@showCategory')->name('show-category');
    Route::get('/{slug}/{id}/{slug-post}/{id-post}','Frontend\PostsDetailController@detailPost')->name('show-detail-posts');
});

Route::group(['prefix' => 'bai-viet','middleware' => 'web'],function(){
    Route::get('/{idcate}/{slug}/{id}','Frontend\PostsDetailController@detailPost')->name('show-detail-posts');
    Route::post('/{idcate}/{slug}/{id}','Frontend\PostsDetailController@saveComment')->name('saveComment');

    // find  cau hoi on tap bang ajax
    Route::post('/question-ajax/{idpost}','Frontend\PostsDetailController@getQuestionAjax')->name('get-question-ajax');

    // find cau hoi on tap cua chuong
    Route::post('/question-ajax-2/{idpost}','Frontend\PostsDetailController@getQuestionAjaxPost')->name('get-question-ajax-post');
});


Route::get('/lam-bai-thi','Frontend\ExamsController@index')->name('indexbaithi');
Route::get('quiz/{categoryID}','Frontend\ExamsController@getQuiz')->name('get.quiz');
Route::get('quiz/create/{categoryID}','Frontend\ExamsController@postQuiz')->name('post.quiz');
Route::post('/lam-bai-thi','Frontend\ExamsController@createExams')->name('taodethi');

Route::get('/lam-bai-quiz','Frontend\ExamsController@getListQuiz')->name('get.quiz.list.view');
Route::get('/lam-bai-quiz/{categoryID}','Frontend\ExamsController@getListQuizByCategory')->name('get.quiz.list.view.by_category');

Route::get('/thong-tin/{id}-{slug}','Frontend\PostsDetailController@thongtin')->name('thongtin');
// lam bai thi
Route::group(['prefix' => 'exams','middleware' => 'checkLoginUser'],function(){
    Route::get('/vao-thi/{iduser}/{idde}/{categoryID}','Frontend\ExamsController@startExams')->name('vaothi');
    Route::post('/vao-thi/{iduser}/{idde}/{categoryID}','Frontend\ExamsController@saveExams')->name('saveDapan');
    Route::get('/kq/{iduser}/{idde}/{categoryID}','Frontend\ExamsController@kqExams')->name('get.kq.quiz');
    Route::get('list-kq','Frontend\ExamsController@listKQ')->name('get.kq.list');
    Route::get('chi-tiet-kq/{id}','Frontend\ExamsController@listKQQuiz')->name('get.kq.list.item');
});

Route::group(['middleware' => 'checkLoginUser'],function(){
    Route::get('thong-tin-ca-nhan','User\ProfileController@index')->name('get.profile');
    Route::post('thong-tin-ca-nhan','User\ProfileController@updateProfile');
    Route::get('cap-nhat-mat-khau','User\ProfileController@getPassword')->name('get.password');
    Route::post('cap-nhat-mat-khau','User\ProfileController@savePassword');
});

// search
Route::get('/tim-kiem','Frontend\HomeController@searchTypehead')->name('searchTypehead');

Route::get('/gioi-thieu.html','Frontend\AboutController@index');
Route::get('/gioi-thieu/{slug?}-{id?}.html','Frontend\AboutController@about_detail');





