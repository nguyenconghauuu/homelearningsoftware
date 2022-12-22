<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\View;
use DB;
use Auth;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
  //   public function infoAdmin()
  //   {
  //   	$infoAdmin = [];
  //   	if( Auth::guard('admins')->check())
		// {
		// 	$id_admin = Auth::guard('admins')->user()->id;
		// 	$infoAdmin = Admins::findOrFail($id_admin);
		// }
		// View::share('infoAdmin', 'infoAdmin');
  //   }
}
