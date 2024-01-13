<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BonusTeamCarTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('bonus_team_car')->delete();
        
        \DB::table('bonus_team_car')->insert(array (
            0 => 
            array (
                'id' => 1,
                'target_amount' => 500000000.0,
                'bonus_amount' => 100000.0,
                'created_at' => '2022-07-21 15:27:13',
                'updated_at' => '2022-07-21 15:27:13',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}