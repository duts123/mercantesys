<?php

use Illuminate\Database\Seeder;

class RCurrenciesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('r_currencies')->delete();
        
        \DB::table('r_currencies')->insert(array (
            0 => 
            array (
                'CURR_ID' => 1,
                'TAXP_ID' => 2,
                'CURR_NAME' => 'Peso',
                'CURR_COUNTRY' => 'Philippines',
                'CURR_SYMBOL' => '₱',
                'CURR_ACR' => 'PHP',
                'CURR_RATE' => 41.5,
                'created_at' => '2019-02-19 05:44:28',
                'updated_at' => '2019-02-19 05:44:28',
            ),
        ));
        
        
    }
}