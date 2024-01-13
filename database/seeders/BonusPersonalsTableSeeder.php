<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BonusPersonalsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('bonus_personals')->delete();
        
        \DB::table('bonus_personals')->insert(array (
            0 => 
            array (
                'id' => 1,
                'point' => '500000',
                'percent' => '2',
                'after_point' => '500000',
                'after_percent' => '0.5',
                'created_at' => '2021-09-09 21:54:21',
                'updated_at' => '2021-09-09 21:54:21',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}