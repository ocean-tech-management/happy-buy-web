<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DiscountsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('discounts')->delete();
        
        \DB::table('discounts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'start_time' => '2021-09-04 15:23:38',
                'end_time' => '2021-12-31 15:23:40',
                'percent' => 50.0,
                'status' => '1',
                'created_at' => '2021-09-04 15:23:48',
                'updated_at' => '2021-09-04 15:46:43',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}