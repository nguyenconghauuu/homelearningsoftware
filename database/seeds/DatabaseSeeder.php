<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminLogin::class);
//        $this->call(Settings::class);
        $this->call(UserSeed::class);
    }
}
