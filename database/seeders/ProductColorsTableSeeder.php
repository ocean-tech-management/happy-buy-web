<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductColorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_colors')->delete();
        
        \DB::table('product_colors')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'BLACK',
                'color' => '#000',
                'status' => '1',
                'created_at' => '2021-09-07 12:36:18',
                'updated_at' => '2021-09-07 12:36:18',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'STONE GREY',
                'color' => '#918E85',
                'status' => '1',
                'created_at' => '2021-09-07 12:36:42',
                'updated_at' => '2021-09-09 12:25:25',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'DIAMOND BLACK',
                'color' => '#001',
                'status' => '1',
                'created_at' => '2021-09-07 12:37:02',
                'updated_at' => '2021-09-07 12:37:02',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'EARTH',
                'color' => '#345',
                'status' => '1',
                'created_at' => '2021-09-07 12:37:18',
                'updated_at' => '2021-09-07 12:37:18',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'SKY BLUE',
                'color' => '#434',
                'status' => '1',
                'created_at' => '2021-09-07 12:37:40',
                'updated_at' => '2021-09-07 12:37:40',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'LAKE GREEN',
                'color' => '#456',
                'status' => '1',
                'created_at' => '2021-09-07 12:37:55',
                'updated_at' => '2021-09-07 12:37:55',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'CHERRY BLOSSOM PURPLE',
                'color' => '#789',
                'status' => '1',
                'created_at' => '2021-09-07 12:38:21',
                'updated_at' => '2021-09-07 12:38:21',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}