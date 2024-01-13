<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('admins')->delete();

        \DB::table('admins')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'admin',
                'password' => bcrypt('password'),
                'phone' => '60167777777',
                'email' => 'admin@admin.com',
                'status' => '0',
                'email_verified_at' => NULL,
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'melvinlam',
                'password' => bcrypt('123456qwer'),
                'phone' => '60177193728',
                'email' => 'lamfeng97@admin.com',
                'status' => '0',
                'email_verified_at' => NULL,
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));


    }
}
