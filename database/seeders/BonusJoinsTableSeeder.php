<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BonusJoinsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('bonus_joins')->delete();
        
        \DB::table('bonus_joins')->insert(array (
            0 => 
            array (
                'id' => 1,
                'first_upline_bonus' => 1800.0,
                'second_upline_bonus' => 900.0,
                'created_at' => '2021-08-23 16:07:46',
                'updated_at' => '2021-08-23 16:07:46',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}