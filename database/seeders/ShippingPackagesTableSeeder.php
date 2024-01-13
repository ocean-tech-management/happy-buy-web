<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ShippingPackagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('shipping_packages')->delete();
        
        \DB::table('shipping_packages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'price' => '10',
                'point' => '10',
                'status' => '1',
                'created_at' => '2021-09-01 14:38:10',
                'updated_at' => '2021-09-01 14:38:10',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'price' => '30',
                'point' => '30',
                'status' => '1',
                'created_at' => '2021-09-01 14:38:21',
                'updated_at' => '2021-09-01 14:38:21',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'price' => '50',
                'point' => '50',
                'status' => '1',
                'created_at' => '2021-09-01 14:39:18',
                'updated_at' => '2021-09-01 14:39:18',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'price' => '100',
                'point' => '100',
                'status' => '1',
                'created_at' => '2021-09-01 14:39:27',
                'updated_at' => '2021-09-01 14:39:27',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}