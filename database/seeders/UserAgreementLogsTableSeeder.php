<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserAgreementLogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('user_agreement_logs')->delete();
        
        \DB::table('user_agreement_logs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'signature_name' => 'Erya Lam',
                'signature_ic' => '970518012345',
                'signature_at' => '2021-12-28 18:05:30',
                'created_at' => '2021-12-28 18:05:30',
                'updated_at' => '2021-12-28 18:05:30',
                'deleted_at' => NULL,
                'user_agreement_id' => 3,
                'user_id' => 5
            ),
        ));
    }
}
