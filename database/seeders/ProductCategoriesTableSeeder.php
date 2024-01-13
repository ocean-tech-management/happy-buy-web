<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_categories')->delete();
        
        \DB::table('product_categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name_en' => 'Lingerie',
                'name_zh' => '内衣',
                'status' => '1',
                'created_at' => '2021-08-18 15:04:41',
                'updated_at' => '2021-09-07 16:36:05',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name_en' => 'Healthy',
                'name_zh' => '健康',
                'status' => '1',
                'created_at' => '2021-08-18 15:04:41',
                'updated_at' => '2021-09-07 16:36:05',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name_en' => 'Sport',
                'name_zh' => '运动',
                'status' => '1',
                'created_at' => '2021-08-18 15:04:41',
                'updated_at' => '2021-09-07 16:36:05',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name_en' => 'Accessories',
                'name_zh' => '周边商品',
                'status' => '1',
                'created_at' => '2021-08-18 15:04:41',
                'updated_at' => '2021-09-07 16:36:05',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}