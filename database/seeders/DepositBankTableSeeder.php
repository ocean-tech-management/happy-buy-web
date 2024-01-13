<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DepositBankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('deposit_banks')->delete();

        \DB::table('deposit_banks')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'bank_account_name' => 'Erya Phoenix',
                    'bank_account_number' => '2233113344',
                    'status' => '1',
                    'created_at' => '2021-08-20 14:44:51',
                    'updated_at' => '2021-08-20 14:44:51',
                    'deleted_at' => NULL,
                    'bank_id' => 1,
                ),
        ));

    }
}
