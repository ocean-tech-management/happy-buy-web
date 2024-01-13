<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('states')->delete();
        
        \DB::table('states')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Johor',
                'status' => '1',
                'created_at' => '2021-08-23 00:15:05',
                'updated_at' => '2021-08-23 00:15:05',
                'deleted_at' => NULL,
                'country_id' => 127,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Kedah',
                'status' => '1',
                'created_at' => '2021-08-23 00:17:01',
                'updated_at' => '2021-08-23 00:17:01',
                'deleted_at' => NULL,
                'country_id' => 127,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Kelantan',
                'status' => '1',
                'created_at' => '2021-08-23 00:17:22',
                'updated_at' => '2021-08-23 00:17:22',
                'deleted_at' => NULL,
                'country_id' => 127,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Melaka',
                'status' => '1',
                'created_at' => '2021-08-23 00:18:15',
                'updated_at' => '2021-08-23 00:18:15',
                'deleted_at' => NULL,
                'country_id' => 127,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Negeri Sembilan',
                'status' => '1',
                'created_at' => '2021-08-23 00:18:32',
                'updated_at' => '2021-08-23 00:18:32',
                'deleted_at' => NULL,
                'country_id' => 127,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Pahang',
                'status' => '1',
                'created_at' => '2021-08-23 00:18:45',
                'updated_at' => '2021-08-23 00:18:45',
                'deleted_at' => NULL,
                'country_id' => 127,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Perak',
                'status' => '1',
                'created_at' => '2021-08-23 00:18:53',
                'updated_at' => '2021-08-23 00:18:53',
                'deleted_at' => NULL,
                'country_id' => 127,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Perlis',
                'status' => '1',
                'created_at' => '2021-08-23 00:19:11',
                'updated_at' => '2021-08-23 00:19:11',
                'deleted_at' => NULL,
                'country_id' => 127,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Pulau Pinang',
                'status' => '1',
                'created_at' => '2021-08-23 00:19:25',
                'updated_at' => '2021-08-23 00:19:25',
                'deleted_at' => NULL,
                'country_id' => 127,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Selangor',
                'status' => '1',
                'created_at' => '2021-08-23 00:19:37',
                'updated_at' => '2021-08-23 00:19:37',
                'deleted_at' => NULL,
                'country_id' => 127,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Terengganu',
                'status' => '1',
                'created_at' => '2021-08-23 00:19:54',
                'updated_at' => '2021-08-23 00:19:54',
                'deleted_at' => NULL,
                'country_id' => 127,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Sabah',
                'status' => '1',
                'created_at' => '2021-08-23 00:20:21',
                'updated_at' => '2021-08-23 00:20:21',
                'deleted_at' => NULL,
                'country_id' => 127,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Sarawak',
                'status' => '1',
                'created_at' => '2021-08-23 00:20:30',
                'updated_at' => '2021-08-23 00:20:30',
                'deleted_at' => NULL,
                'country_id' => 127,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Wilayah Persekutuan Kuala Lumpur',
                'status' => '1',
                'created_at' => '2021-08-23 00:20:48',
                'updated_at' => '2021-08-23 00:20:48',
                'deleted_at' => NULL,
                'country_id' => 127,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Wilayah Persekutuan Labuan',
                'status' => '1',
                'created_at' => '2021-08-23 00:20:57',
                'updated_at' => '2021-08-23 00:20:57',
                'deleted_at' => NULL,
                'country_id' => 127,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Wilayah Persekutuan Putrajaya',
                'status' => '1',
                'created_at' => '2021-08-23 00:21:07',
                'updated_at' => '2021-08-23 00:21:07',
                'deleted_at' => NULL,
                'country_id' => 127,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Singapore',
                'status' => '1',
                'created_at' => '2021-09-11 18:31:22',
                'updated_at' => '2021-09-11 18:31:22',
                'deleted_at' => NULL,
                'country_id' => 193,
            ),
        ));
        
        
    }
}