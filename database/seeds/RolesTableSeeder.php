<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    //role names in their order
    private $_roles = ['admin', 'user'];

    public function run()
    {
        foreach ($this->_roles as $role) {
            DB::table('roles')->insert([
                'name' => $role,
            ]);
        }
    }
}
