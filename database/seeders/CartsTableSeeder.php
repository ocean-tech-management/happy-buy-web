<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('carts')->delete();
        
        \DB::table('carts')->insert(array (
            0 =>
            array (
                'id' => 1,
                'quantity' => 97,
                'status' => '2',
                'created_at' => '2021-12-31 09:55:55',
                'updated_at' => '2021-12-31 10:28:32',
                'deleted_at' => NULL,
                'user_id' => '5',
                'product_id' => '1',
                'product_variant_id' => '2',
                'address_id' => NULL,
                'to_user_id' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'quantity' => 1,
                'status' => '2',
                'created_at' => '2021-12-31 09:55:55',
                'updated_at' => '2021-12-31 10:44:33',
                'deleted_at' => NULL,
                'user_id' => '5',
                'product_id' => '1',
                'product_variant_id' => '1',
                'address_id' => NULL,
                'to_user_id' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'quantity' => 1,
                'status' => '2',
                'created_at' => '2021-12-31 09:55:55',
                'updated_at' => '2021-12-31 11:18:24',
                'deleted_at' => NULL,
                'user_id' => '5',
                'product_id' => '1',
                'product_variant_id' => '1',
                'address_id' => NULL,
                'to_user_id' => NULL,
            ),
            3  =>
            array (
                'id' => 4,
                'quantity' => 2,
                'status' => '2',
                'created_at' => '2021-12-31 09:55:55',
                'updated_at' => '2021-12-31 11:21:28',
                'deleted_at' => NULL,
                'user_id' => '5',
                'product_id' => '1',
                'product_variant_id' => '1',
                'address_id' => NULL,
                'to_user_id' => NULL,
            ),
            4  =>
            array (
                'id' => 5,
                'quantity' => 1,
                'status' => '2',
                'created_at' => '2021-12-31 09:55:55',
                'updated_at' => '2021-12-31 14:30:56',
                'deleted_at' => NULL,
                'user_id' => '5',
                'product_id' => '1',
                'product_variant_id' => '1',
                'address_id' => NULL,
                'to_user_id' => NULL,
            ),
        ));
    }
}
