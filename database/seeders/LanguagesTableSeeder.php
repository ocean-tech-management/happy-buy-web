<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('languages')->delete();
        
        \DB::table('languages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'English',
                'code' => 'en',
                'status' => '0',
                'created_at' => '2022-01-07 12:31:35',
                'updated_at' => '2022-01-07 12:31:35',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Chinese',
                'code' => 'zh-Hans',
                'status' => '0',
                'created_at' => '2022-01-07 12:32:04',
                'updated_at' => '2022-01-07 12:32:04',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}