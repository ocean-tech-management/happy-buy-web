<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PointPackagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('point_packages')->delete();

        \DB::table('point_packages')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name_en' => 'Silver',
                'name_zh' => '银',
                'price' => 3300.0,
                'point' => 3300.0,
                'deduct_point' => '3000',
                'deduct_2_level_point' => '2700',
                'status' => '1',
                'created_at' => '2021-08-18 11:25:32',
                'updated_at' => '2021-08-18 11:25:32',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'name_en' => 'Gold',
                'name_zh' => '金',
                'price' => 10000.0,
                'point' => 10000.0,
                'deduct_point' => '9000',
                'deduct_2_level_point' => '8000',
                'status' => '1',
                'created_at' => '2021-08-18 11:26:05',
                'updated_at' => '2021-08-18 11:26:05',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'name_en' => 'Diamond',
                'name_zh' => '钻石',
                'price' => 27000.0,
                'point' => 27000.0,
                'deduct_point' => '24300',
                'deduct_2_level_point' => '21600',
                'status' => '1',
                'created_at' => '2021-08-18 11:26:55',
                'updated_at' => '2021-08-18 11:26:55',
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 99,
                'name_en' => 'Cleared',
                'name_zh' => '清零',
                'price' => 0.0,
                'point' => 0.0,
                'deduct_point' => '0',
                'deduct_2_level_point' => '0',
                'status' => '1',
                'created_at' => '2021-09-09 16:55:51',
                'updated_at' => '2021-09-09 16:56:03',
                'deleted_at' => NULL,
            ),
        ));


    }
}
