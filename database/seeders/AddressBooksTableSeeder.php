<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AddressBooksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('address_books')->delete();

        \DB::table('address_books')->insert(array (
            0 =>
            array (
                'id' => 1,
                'remark' => 'Office',
                'name' => 'Test merchant',
                'phone' => '60167524533',
                'address_1' => '11 ffffsf',
                'address_2' => NULL,
                'city' => 'Test City',
                'state_id' => '1',
                'postcode' => '111111',
                'set_default' => '1',
                'status' => '1',
                'created_at' => '2021-08-19 00:42:32',
                'updated_at' => '2021-08-19 00:42:32',
                'deleted_at' => NULL,
                'user_id' => 1,
            ),
            1 =>
            array (
                'id' => 2,
                'remark' => 'Home',
                'name' => 'Test Merchant',
                'phone' => '60167524534',
                'address_1' => '11 ffffsf',
                'address_2' => NULL,
                'city' => 'Test City',
                'state_id' => '1',
                'postcode' => '12345',
                'set_default' => '1',
                'status' => '1',
                'created_at' => '2021-08-19 00:45:20',
                'updated_at' => '2021-08-19 00:45:20',
                'deleted_at' => NULL,
                'user_id' => 2,
            ),
            2 =>
            array (
                'id' => 3,
                'remark' => 'Home',
                'name' => 'Test Merchant',
                'phone' => '60167524534',
                'address_1' => '11 ffffsf',
                'address_2' => NULL,
                'city' => 'Test City',
                'state_id' => '1',
                'postcode' => '12345',
                'set_default' => '1',
                'status' => '1',
                'created_at' => '2021-08-19 00:45:20',
                'updated_at' => '2021-08-19 00:45:20',
                'deleted_at' => NULL,
                'user_id' => 3,
            ),
            3 =>
            array (
                'id' => 4,
                'remark' => 'Home',
                'name' => 'Test Merchant',
                'phone' => '60167524534',
                'address_1' => '11 ffffsf',
                'address_2' => NULL,
                'city' => 'Test City',
                'state_id' => '1',
                'postcode' => '12345',
                'set_default' => '1',
                'status' => '1',
                'created_at' => '2021-08-19 00:45:20',
                'updated_at' => '2021-08-19 00:45:20',
                'deleted_at' => NULL,
                'user_id' => 4,
            ),
            4 =>
            array (
                'id' => 5,
                'remark' => 'Home',
                'name' => 'Test Merchant',
                'phone' => '6012345667',
                'address_1' => '11 aaa',
                'address_2' => NULL,
                'city' => 'Test City',
                'state_id' => '1',
                'postcode' => '12345',
                'set_default' => '1',
                'status' => '1',
                'created_at' => '2021-12-28 18:00:00',
                'updated_at' => '2021-12-28 18:00:00',
                'deleted_at' => NULL,
                'user_id' => 5,
            ),
            5 =>
            array (
                'id' => 6,
                'remark' => 'Home',
                'name' => 'Test Merchant',
                'phone' => '60123431123',
                'address_1' => '11 bbb',
                'address_2' => NULL,
                'city' => 'Test City',
                'state_id' => '1',
                'postcode' => '12345',
                'set_default' => '1',
                'status' => '1',
                'created_at' => '2021-12-29 18:00:00',
                'updated_at' => '2021-12-29 18:00:00',
                'deleted_at' => NULL,
                'user_id' => 6,
            ),
            6 =>
            array (
                'id' => 7,
                'remark' => 'Home',
                'name' => 'Test Merchant',
                'phone' => '60131231242',
                'address_1' => '11 ccc',
                'address_2' => NULL,
                'city' => 'Test City',
                'state_id' => '1',
                'postcode' => '12345',
                'set_default' => '1',
                'status' => '1',
                'created_at' => '2021-12-30 18:00:00',
                'updated_at' => '2021-12-30 18:00:00',
                'deleted_at' => NULL,
                'user_id' => 7,
            )
        ));


    }
}
