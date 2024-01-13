<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ShippingFeesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('shipping_fees')->delete();
        
        \DB::table('shipping_fees')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'West Malaysia',
                'quantity' => '4',
                'price' => '8',
                'add_on' => '0',
                'status' => '1',
                'created_at' => '2021-09-11 18:42:45',
                'updated_at' => '2021-09-11 18:42:45',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'East Malaysia',
                'quantity' => '2',
                'price' => '15',
                'add_on' => '1.5',
                'status' => '1',
                'created_at' => '2021-09-11 18:43:19',
                'updated_at' => '2021-09-11 18:43:19',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Singapore 1-3',
                'quantity' => '3',
                'price' => '15',
                'add_on' => '0',
                'status' => '1',
                'created_at' => '2021-09-11 18:43:52',
                'updated_at' => '2021-09-11 18:43:52',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Singapore 4-8',
                'quantity' => '8',
                'price' => '25',
                'add_on' => '3',
                'status' => '1',
                'created_at' => '2021-09-11 18:44:17',
                'updated_at' => '2021-09-11 18:44:17',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}