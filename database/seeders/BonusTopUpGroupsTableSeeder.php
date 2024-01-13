<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BonusTopUpGroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('bonus_top_up_groups')->delete();
        
        \DB::table('bonus_top_up_groups')->insert(array (
            0 => 
            array (
                'id' => 1,
                'first_upline_bonus' => 800.0,
                'second_upline_bonus' => 400.0,
                'created_at' => '2021-08-30 05:02:05',
                'updated_at' => '2021-08-30 05:02:05',
                'deleted_at' => NULL,
                'point_package_id' => 3,
            ),
        ));
        
        
    }
}