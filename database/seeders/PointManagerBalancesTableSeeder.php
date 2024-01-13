<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PointManagerBalancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('point_manager_balances')->delete();

        \DB::table('point_manager_balances')->insert(array (
            0 =>
            array (
                'id' => 1,
                'amount' => '2000',
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
                'amount' => '3800',
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
                'amount' => '6000',
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
                'amount' => '7800',
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
                'amount' => '5200',
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
                'amount' => '10000',
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
                'amount' => '6500',
                'status' => '1', 
                'settlement' => '1',
                'remark' => 'Test',
                'user_id' => '7',
                'created_at' => '2021-12-30 15:00:00',
                'updated_at' => '2021-12-30 15:00:00',
                'deleted_at' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'amount' => '-9700',
                'status' => '1', 
                'settlement' => '1',
                'remark' => 'redeem order ERYARP20211231102832R1',
                'user_id' => '5',
                'created_at' => '2021-12-31 10:28:32',
                'updated_at' => '2021-12-31 10:28:32',
                'deleted_at' => NULL,
            ),
            8 =>
            array (
                'id' => 9,
                'amount' => '-100',
                'status' => '1', 
                'settlement' => '1',
                'remark' => 'redeem order ERYARP20211231143056R5',
                'user_id' => '5',
                'created_at' => '2021-12-31 14:30:56',
                'updated_at' => '2021-12-31 14:30:56',
                'deleted_at' => NULL,
            ),
        ));
    }
}
