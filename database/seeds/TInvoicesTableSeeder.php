<?php

use Illuminate\Database\Seeder;

class TInvoicesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('t_invoices')->delete();
        
        \DB::table('t_invoices')->insert(array (
            0 => 
            array (
                'INV_ID' => 5,
                'ORD_ID' => 10,
                'INV_NO' => 'SYMPIES-5c755f5cdeacb',
                'INV_STATUS' => 'completed',
                'INV_DETAILS' => 'Thank you for purchasing on SympiesShop',
                'created_at' => '2019-02-26 16:07:46',
                'updated_at' => '2019-02-26 16:07:46',
            ),
            1 => 
            array (
                'INV_ID' => 7,
                'ORD_ID' => 12,
                'INV_NO' => 'SYMPIES-5c75792628d22',
                'INV_STATUS' => 'pending',
                'INV_DETAILS' => 'Thank you for purchasing on SympiesShop',
                'created_at' => '2019-02-26 17:37:47',
                'updated_at' => '2019-02-26 17:37:47',
            ),
            2 => 
            array (
                'INV_ID' => 8,
                'ORD_ID' => 13,
                'INV_NO' => 'SYMPIES-5c7579a94dc94',
                'INV_STATUS' => 'pending',
                'INV_DETAILS' => 'Thank you for purchasing on SympiesShop',
                'created_at' => '2019-02-26 17:39:37',
                'updated_at' => '2019-02-26 17:39:37',
            ),
        ));
        
        
    }
}