<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ShippingCompaniesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('shipping_companies')->delete();

        \DB::table('shipping_companies')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Pos Laju',
                'api_name' => 'poslaju',
                'status' => '1',
                'created_at' => '2021-08-19 03:44:18',
                'updated_at' => '2021-08-23 00:24:06',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'DHL Ecommerce',
                'api_name' => 'dhl-ecommerce',
                'status' => '1',
                'created_at' => '2021-08-23 00:23:41',
                'updated_at' => '2021-08-23 00:23:41',
                'deleted_at' => NULL,
            ),
        ));


    }
}
