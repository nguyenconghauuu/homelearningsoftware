<?php

use Illuminate\Database\Seeder;

class Settings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = array(
            [
                'name'              => ' Website quản lý | Bán hàng | Tin tức ',
                'email'             => 'website@gmail.com',
                'address'           => ' Quỳnh Ngọc - Quỳnh Lưu - Nghệ An '
            ]
        );

        foreach ($admins as $value)
        {
            \Illuminate\Support\Facades\DB::table('settings')->insert([
                'name' 			=> $value['name'],
                'email' 		=> $value['email'],
                'address' 		=> $value['address']
            ]);
        }
    }
}
