<?php
namespace App\Units; 
use Auth;
use App\Admins;
class FunctionCheck 
{
	public static function checkLoginAdmin()
	{
		if(Auth::guard('admins')->check())
		{
			return true;
		}	return false;
	}
	public static function getInfoAdmin ()
	{
		$infoAdminLogin = [];
		if(self::checkLoginAdmin())
		{
			$id = Auth::guard('admins')->user()->id;
			$infoAdminLogin = Admins::FindOrFail($id);
		}
		return $infoAdminLogin;
	}

	public static function getNameAdmin()
	{
		$name = '';
		if(self::getInfoAdmin())
		{
			$name = self::getInfoAdmin()->name;
		}
		return $name;
	}
}