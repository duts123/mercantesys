<?php

use Illuminate\Database\Seeder;

class RAffiliateInfosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('r_affiliate_infos')->delete();
        
        \DB::table('r_affiliate_infos')->insert(array (
            0 => 
            array (
                'AFF_ID' => 1,
                'AFF_CODE' => 'SYMP-2019-1',
                'AFF_NAME' => 'Sympies',
                'AFF_DESC' => 'Sympies Description',
                'AFF_PAYMENT_INSTRUCTION' => 'Instruction',
                'AFF_PAYMENT_MODE' => 'Bank',
                'AFF_DISPLAY_STATUS' => 1,
                'created_at' => '2019-02-19 05:43:42',
                'updated_at' => '2019-02-19 05:43:42',
            ),
            1 => 
            array (
                'AFF_ID' => 2,
                'AFF_CODE' => 'ISL-2019-1',
                'AFF_NAME' => 'Island Rose',
                'AFF_DESC' => 'Island Rose Description',
                'AFF_PAYMENT_INSTRUCTION' => 'Instruction',
                'AFF_PAYMENT_MODE' => 'Bank',
                'AFF_DISPLAY_STATUS' => 1,
                'created_at' => '2019-02-19 05:43:42',
                'updated_at' => '2019-02-19 05:43:42',
            ),
        ));
        
        
    }
}