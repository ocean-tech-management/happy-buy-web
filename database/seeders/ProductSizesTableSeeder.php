<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductSizesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_sizes')->delete();
        
        \DB::table('product_sizes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'S',
                'status' => '1',
                'created_at' => '2021-09-07 12:28:35',
                'updated_at' => '2021-09-07 12:28:35',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'M',
                'status' => '1',
                'created_at' => '2021-09-07 12:35:27',
                'updated_at' => '2021-09-07 12:35:27',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'L',
                'status' => '1',
                'created_at' => '2021-09-07 12:35:32',
                'updated_at' => '2021-09-07 12:35:32',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'XL',
                'status' => '1',
                'created_at' => '2021-09-07 12:35:38',
                'updated_at' => '2021-09-07 12:35:38',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'XXL',
                'status' => '1',
                'created_at' => '2021-09-07 12:35:42',
                'updated_at' => '2021-09-07 12:35:42',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}