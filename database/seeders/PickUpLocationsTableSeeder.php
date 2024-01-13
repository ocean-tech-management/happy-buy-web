<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PickUpLocationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('pick_up_locations')->delete();

        \DB::table('pick_up_locations')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Sarawak Kuching',
                'person_in_charge' => 'Susana Wong',
                'phone' => '60168886253',
                'address' => '706D, Lorong 1,  Jalan Stampin Tengah 93350 Kuching Sarawak',
                'status' => '1',
                'created_at' => '2021-09-12 01:44:29',
                'updated_at' => '2021-09-13 13:46:03',
                'deleted_at' => NULL,
                'country_id' => 127,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Sarawak Mukah',
                'person_in_charge' => 'Joanna Tiong',
                'phone' => '0168836528',
                'address' => '30 Medan Setiaraja  96400 Mukah  Sarawak',
                'status' => '1',
                'created_at' => '2021-09-13 13:47:01',
                'updated_at' => '2021-09-13 13:47:01',
                'deleted_at' => NULL,
                'country_id' => 127,
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Erya Phoenix Sdn Bhd',
                'person_in_charge' => 'Venus',
                'phone' => '0127430399',
                'address' => 'No 25, Jalan Perniagaan Pusat Perniagaan Kenanga Muar Batu 1 1/4 Jalan Bakri Bakri, 84000 Muar, Johor',
                'status' => '1',
                'created_at' => '2021-09-13 13:47:44',
                'updated_at' => '2021-09-13 13:47:44',
                'deleted_at' => NULL,
                'country_id' => 127,
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Singapore',
                'person_in_charge' => 'Elise',
                'phone' => '6583632534',
                'address' => 'BLK 205C, compassvale Lane, #12-33  Singapore 543205',
                'status' => '1',
                'created_at' => '2021-09-13 13:48:17',
                'updated_at' => '2021-09-13 13:48:17',
                'deleted_at' => NULL,
                'country_id' => 193,
            ),
        ));


    }
}
