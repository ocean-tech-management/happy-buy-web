<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PVBalancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('pv_balances')->delete();

        \DB::table('pv_balances')->insert(array (
            0 =>
            array (
                'id' => 1,
                'amount' => '5000',
                'status' => '1', 
                'settlement' => '1',
                'remark' => 'Test',
                'user_id' => '5',
                'created_at' => '2021-12-30 15:00:00',
                'updated_at' => '2021-12-30 15:00:00',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'amount' => '1800',
                'status' => '2', 
                'settlement' => '1',
                'remark' => 'Test',
                'user_id' => '5',
                'created_at' => '2021-12-30 15:00:00',
                'updated_at' => '2021-12-30 15:00:00',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'amount' => '3000',
                'status' => '1', 
                'settlement' => '1',
                'remark' => 'Test',
                'user_id' => '5',
                'created_at' => '2021-12-30 15:00:00',
                'updated_at' => '2021-12-30 15:00:00',
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'amount' => '4000',
                'status' => '1', 
                'settlement' => '1',
                'remark' => 'Test',
                'user_id' => '6',
                'created_at' => '2021-12-30 15:00:00',
                'updated_at' => '2021-12-30 15:00:00',
                'deleted_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'amount' => '6300',
                'status' => '2',  
                'settlement' => '1',
                'remark' => 'Test',
                'user_id' => '6',
                'created_at' => '2021-12-30 15:00:00',
                'updated_at' => '2021-12-30 15:00:00',
                'deleted_at' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'amount' => '5800',
                'status' => '1', 
                'settlement' => '1',
                'remark' => 'Test',
                'user_id' => '6',
                'created_at' => '2021-12-30 15:00:00',
                'updated_at' => '2021-12-30 15:00:00',
                'deleted_at' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'amount' => '5500',
                'status' => '1', 
                'settlement' => '1',
                'remark' => 'Test',
                'user_id' => '7',
                'created_at' => '2021-12-30 15:00:00',
                'updated_at' => '2021-12-30 15:00:00',
                'deleted_at' => NULL,
            ),
        ));
    }
}
