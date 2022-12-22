<?php

use Illuminate\Database\Seeder;

class AdminLogin extends Seeder
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
                'name'              => 'TrungPhuNA',
                'email'             => 'doantotnghiep@gmail.com',
                'password'          => '123456789'
            ]
        );

        foreach ($admins as $value)
        {
            \Illuminate\Support\Facades\DB::table('admins')->insert([
                'name' 			=> $value['name'],
                'email' 		=> $value['email'],
                'password' 		=> bcrypt($value['password']),
            ]);
        }
    }
}
