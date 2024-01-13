<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ShippingBalancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('shipping_balances')->delete();

        \DB::table('shipping_balances')->insert(array (
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
                'amount' => '6600',
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
                'amount' => '5000',
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
                'amount' => '3500',
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
                'amount' => '3300',
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
                'amount' => '-202',
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
                'amount' => '-8',
                'status' => '1', 
                'settlement' => '1',
                'remark' => 'redeem order ERYARP20211231104433R2',
                'user_id' => '5',
                'created_at' => '2021-12-31 10:44:33',
                'updated_at' => '2021-12-31 10:44:33',
                'deleted_at' => NULL,
            ),
            9 =>
            array (
                'id' => 10,
                'amount' => '-8',
                'status' => '1', 
                'settlement' => '1',
                'remark' => 'redeem order ERYARP20211231111824R3',
                'user_id' => '5',
                'created_at' => '2021-12-31 11:18:24',
                'updated_at' => '2021-12-31 11:18:24',
                'deleted_at' => NULL,
            ),
            10 =>
            array (
                'id' => 11,
                'amount' => '8',
                'status' => '1', 
                'settlement' => '1',
                'remark' => 'refund order ERYARP20211231111824R3',
                'user_id' => '5',
                'created_at' => '2021-12-31 11:19:32',
                'updated_at' => '2021-12-31 11:19:32',
                'deleted_at' => NULL,
            ),
        ));
    }
}
