<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    // user names
    private $_names = ['admin', 'user'];

    public function run()
    {
        // iterating over names
        for ($i=0; $i < count($this->_names); $i++) {
            DB::table('users')->insert([
                'name' => $this->_names[$i],
                    //creating emails from names as well
                'email' => $this->_names[$i].'@mail.com',
                'password' => bcrypt('password'),
                    // admin role id = 1
                    // user role id = 2
                'role_id' => $i+1,
            ]);
        }
    }

}
