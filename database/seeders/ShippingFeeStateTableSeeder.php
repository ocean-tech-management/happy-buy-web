<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ShippingFeeStateTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('shipping_fee_state')->delete();
        
        \DB::table('shipping_fee_state')->insert(array (
            0 => 
            array (
                'shipping_fee_id' => 1,
                'state_id' => 1,
            ),
            1 => 
            array (
                'shipping_fee_id' => 1,
                'state_id' => 2,
            ),
            2 => 
            array (
                'shipping_fee_id' => 1,
                'state_id' => 3,
            ),
            3 => 
            array (
                'shipping_fee_id' => 1,
                'state_id' => 4,
            ),
            4 => 
            array (
                'shipping_fee_id' => 1,
                'state_id' => 5,
            ),
            5 => 
            array (
                'shipping_fee_id' => 1,
                'state_id' => 6,
            ),
            6 => 
            array (
                'shipping_fee_id' => 1,
                'state_id' => 7,
            ),
            7 => 
            array (
                'shipping_fee_id' => 1,
                'state_id' => 8,
            ),
            8 => 
            array (
                'shipping_fee_id' => 1,
                'state_id' => 9,
            ),
            9 => 
            array (
                'shipping_fee_id' => 1,
                'state_id' => 10,
            ),
            10 => 
            array (
                'shipping_fee_id' => 1,
                'state_id' => 11,
            ),
            11 => 
            array (
                'shipping_fee_id' => 1,
                'state_id' => 14,
            ),
            12 => 
            array (
                'shipping_fee_id' => 1,
                'state_id' => 15,
            ),
            13 => 
            array (
                'shipping_fee_id' => 1,
                'state_id' => 16,
            ),
            14 => 
            array (
                'shipping_fee_id' => 2,
                'state_id' => 12,
            ),
            15 => 
            array (
                'shipping_fee_id' => 2,
                'state_id' => 13,
            ),
            16 => 
            array (
                'shipping_fee_id' => 3,
                'state_id' => 17,
            ),
            17 => 
            array (
                'shipping_fee_id' => 4,
                'state_id' => 17,
            ),
        ));
        
        
    }
}