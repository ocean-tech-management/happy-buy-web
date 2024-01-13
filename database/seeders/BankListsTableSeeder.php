<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BankListsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('bank_lists')->delete();

        \DB::table('bank_lists')->insert(array (
            0 =>
            array (
                'id' => 1,
                'code' => 'MAYBANK',
                'bank_name' => 'MAYBANK',
                'status' => '1',
                'created_at' => '2021-08-20 14:44:51',
                'updated_at' => '2021-08-20 14:44:51',
                'deleted_at' => NULL,
            ),
            1 =>
                array (
                    'id' => 2,
                    'code' => 'CIMB',
                    'bank_name' => 'CIMB',
                    'status' => '1',
                    'created_at' => '2021-08-20 14:44:51',
                    'updated_at' => '2021-08-20 14:44:51',
                    'deleted_at' => NULL,
                ),
            2 =>
                array (
                    'id' => 3,
                    'code' => 'Affin Bank',
                    'bank_name' => 'Affin Bank',
                    'status' => '1',
                    'created_at' => '2021-08-20 14:44:51',
                    'updated_at' => '2021-08-20 14:44:51',
                    'deleted_at' => NULL,
                ),
            3 =>
                array (
                    'id' => 4,
                    'code' => 'RHB Bank',
                    'bank_name' => 'RHB Bank',
                    'status' => '1',
                    'created_at' => '2021-08-20 14:44:51',
                    'updated_at' => '2021-08-20 14:44:51',
                    'deleted_at' => NULL,
                ),
            4 =>
                array (
                    'id' => 5,
                    'code' => 'Hong Leong Bank',
                    'bank_name' => 'Hong Leong Bank',
                    'status' => '1',
                    'created_at' => '2021-08-20 14:44:51',
                    'updated_at' => '2021-08-20 14:44:51',
                    'deleted_at' => NULL,
                ),
            5 =>
                array (
                    'id' => 6,
                    'code' => 'HSBC Bank',
                    'bank_name' => 'HSBC Bank',
                    'status' => '1',
                    'created_at' => '2021-08-20 14:44:51',
                    'updated_at' => '2021-08-20 14:44:51',
                    'deleted_at' => NULL,
                ),
            6 =>
                array (
                    'id' => 7,
                    'code' => 'AmBank',
                    'bank_name' => 'AmBank',
                    'status' => '1',
                    'created_at' => '2021-08-20 14:44:51',
                    'updated_at' => '2021-08-20 14:44:51',
                    'deleted_at' => NULL,
                ),
            7 =>
                array (
                    'id' => 8,
                    'code' => 'Standard Chartered Bank',
                    'bank_name' => 'Standard Chartered Bank',
                    'status' => '1',
                    'created_at' => '2021-08-20 14:44:51',
                    'updated_at' => '2021-08-20 14:44:51',
                    'deleted_at' => NULL,
                ),
            8 =>
                array (
                    'id' => 9,
                    'code' => 'Public Bank',
                    'bank_name' => 'Public Bank',
                    'status' => '1',
                    'created_at' => '2021-08-20 14:44:51',
                    'updated_at' => '2021-08-20 14:44:51',
                    'deleted_at' => NULL,
                ),
            9 =>
                array (
                    'id' => 10,
                    'code' => 'Alliance Bank',
                    'bank_name' => 'Alliance Bank',
                    'status' => '1',
                    'created_at' => '2021-08-20 14:44:51',
                    'updated_at' => '2021-08-20 14:44:51',
                    'deleted_at' => NULL,
                ),
            10 =>
                array (
                    'id' => 11,
                    'code' => 'Agro Bank',
                    'bank_name' => 'Agro Bank',
                    'status' => '1',
                    'created_at' => '2021-08-20 14:44:51',
                    'updated_at' => '2021-08-20 14:44:51',
                    'deleted_at' => NULL,
                ),
            11 =>
                array (
                    'id' => 12,
                    'code' => 'Bank Muamalat',
                    'bank_name' => 'Bank Muamalat',
                    'status' => '1',
                    'created_at' => '2021-08-20 14:44:51',
                    'updated_at' => '2021-08-20 14:44:51',
                    'deleted_at' => NULL,
                ),
            12 =>
                array (
                    'id' => 13,
                    'code' => 'UOB',
                    'bank_name' => 'UOB',
                    'status' => '1',
                    'created_at' => '2021-08-20 14:44:51',
                    'updated_at' => '2021-08-20 14:44:51',
                    'deleted_at' => NULL,
                ),
            13 =>
                array (
                    'id' => 14,
                    'code' => 'OCBC Bank',
                    'bank_name' => 'OCBC Bank',
                    'status' => '1',
                    'created_at' => '2021-08-20 14:44:51',
                    'updated_at' => '2021-08-20 14:44:51',
                    'deleted_at' => NULL,
                ),
            14 =>
                array (
                    'id' => 15,
                    'code' => 'Exim Bank',
                    'bank_name' => 'Exim Bank',
                    'status' => '1',
                    'created_at' => '2021-08-20 14:44:51',
                    'updated_at' => '2021-08-20 14:44:51',
                    'deleted_at' => NULL,
                ),
        ));


    }
}
