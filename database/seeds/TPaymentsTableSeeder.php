<?php

use Illuminate\Database\Seeder;

class TPaymentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('t_payments')->delete();
        
        \DB::table('t_payments')->insert(array (
            0 => 
            array (
                'PAY_ID' => 4,
                'INV_ID' => 5,
                'PAY_RECIEVED_BY' => 'SympiesShop',
                'PAY_SUB_TOTAL' => 1000,
                'PAY_SALES_TAX' => 1000,
                'PAY_DELIVERY_CHARGE' => 20,
                'PAY_AMOUNT_DUE' => 4724.0,
                'PAY_CAPTURED_AT' => '2019-02-26 16:07:46',
                'created_at' => '2019-02-26 16:07:46',
                'updated_at' => '2019-02-26 16:07:46',
            ),
            1 => 
            array (
                'PAY_ID' => 6,
                'INV_ID' => 7,
                'PAY_RECIEVED_BY' => 'SympiesShop',
                'PAY_SUB_TOTAL' => 1000,
                'PAY_SALES_TAX' => 1000,
                'PAY_DELIVERY_CHARGE' => 20,
                'PAY_AMOUNT_DUE' => 2372.0,
                'PAY_CAPTURED_AT' => '2019-02-26 17:37:47',
                'created_at' => '2019-02-26 17:37:47',
                'updated_at' => '2019-02-26 17:37:47',
            ),
            2 => 
            array (
                'PAY_ID' => 7,
                'INV_ID' => 8,
                'PAY_RECIEVED_BY' => 'SympiesShop',
                'PAY_SUB_TOTAL' => 1000,
                'PAY_SALES_TAX' => 1000,
                'PAY_DELIVERY_CHARGE' => 20,
                'PAY_AMOUNT_DUE' => 7860.0,
                'PAY_CAPTURED_AT' => '2019-02-26 17:39:37',
                'created_at' => '2019-02-26 17:39:37',
                'updated_at' => '2019-02-26 17:39:37',
            ),
        ));
        
        
    }
}