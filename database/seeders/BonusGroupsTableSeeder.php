<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BonusGroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('bonus_groups')->delete();
        
        \DB::table('bonus_groups')->insert(array (
            0 => 
            array (
                'id' => 1,
                'point' => '200000',
                'percent' => '1',
                'after_point' => '200000',
                'after_percent' => '0.5',
                'created_at' => '2021-09-09 21:53:35',
                'updated_at' => '2021-09-09 21:54:51',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}