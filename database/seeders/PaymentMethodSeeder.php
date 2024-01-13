<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('payment_methods')->delete();

        \DB::table('payment_methods')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'Upload Receipt',
                    'status' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'Online Banking / Credit Card',
                    'status' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'Bonus Points',
                    'status' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
            3  =>
                array (
                    'id' => 4,
                    'name' => 'Points',
                    'status' => 1,
                    'created_at' => NULL,
                    'updated_at' => NULL,
                    'deleted_at' => NULL,
                ),
        ));
    }
}
