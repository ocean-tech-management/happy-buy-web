<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BonusVIPTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('bonus_vip')->delete();

        \DB::table('bonus_vip')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'VIP Free Cash Voucher',
                'slug' => 'free_cash_voucher',
                'target_amount' => '98',
                'bonus_reward' => '688',
                'status' => '1',
                'start_date' => '2021-12-31 12:30:00',
                'end_date'   => '2022-02-14 12:00:00',
                'created_at' => '2021-12-26 12:31:37',
                'updated_at' => '2021-12-26 12:31:37',
                'deleted_at' => NULL,
            ),
        ));
    }
}
