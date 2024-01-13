<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('roles')->delete();

        \DB::table('roles')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Admin',
                'guard_name' => 'admin',
                'created_at' => '2021-08-01 23:31:37',
                'updated_at' => '2021-08-01 23:31:37',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Merchant-Millionaire',
                'guard_name' => 'user',
                'created_at' => '2021-08-01 23:31:37',
                'updated_at' => '2021-08-31 16:06:11',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Agent-Executive',
                'guard_name' => 'user',
                'created_at' => '2021-08-01 23:31:37',
                'updated_at' => '2021-08-31 16:06:36',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Agent-Manager',
                'guard_name' => 'user',
                'created_at' => '2021-08-01 23:31:37',
                'updated_at' => '2021-08-31 16:06:36',
            ),
        ));


    }
}
