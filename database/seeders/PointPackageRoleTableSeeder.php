<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PointPackageRoleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('point_package_role')->delete();
        
        \DB::table('point_package_role')->insert(array (
            0 => 
            array (
                'point_package_id' => 1,
                'role_id' => 3,
            ),
            1 => 
            array (
                'point_package_id' => 1,
                'role_id' => 2,
            ),
            2 => 
            array (
                'point_package_id' => 2,
                'role_id' => 2,
            ),
            3 => 
            array (
                'point_package_id' => 3,
                'role_id' => 2,
            ),
            4 => 
            array (
                'point_package_id' => 2,
                'role_id' => 4,
            ),
        ));
        
        
    }
}