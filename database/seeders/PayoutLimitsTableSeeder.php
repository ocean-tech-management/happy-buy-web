<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PayoutLimitsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('payout_limits')->delete();
        
        \DB::table('payout_limits')->insert(array (
            0 => 
            array (
                'created_at' => '2021-08-18 10:41:51',
                'deleted_at' => NULL,
                'id' => 1,
                'max_amount' => '1000.00',
                'min_amount' => '50.00',
                'role_id' => 2,
                'updated_at' => '2021-08-18 10:41:51',
            ),
        ));
        
        
    }
}