<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BonusTopUpPersonalsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('bonus_top_up_personals')->delete();
        
        \DB::table('bonus_top_up_personals')->insert(array (
            0 => 
            array (
                'id' => 1,
                'first_upline_bonus' => 200.0,
                'second_upline_bonus' => 100.0,
                'created_at' => '2021-08-30 05:02:56',
                'updated_at' => '2021-08-30 05:02:56',
                'deleted_at' => NULL,
                'point_package_id' => 3,
            ),
        ));
        
        
    }
}