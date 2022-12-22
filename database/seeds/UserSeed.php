    <?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
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
                'email'             => 'phupt@gmail.com',
                'password'          => '123456'
            ]
        );

        foreach ($admins as $value)
        {
            \Illuminate\Support\Facades\DB::table('users')->insert([
                'u_name' 			=> $value['name'],
                'u_email' 		    => $value['email'],
                'u_password' 		=> bcrypt($value['password']),
            ]);
        }
    }
}
