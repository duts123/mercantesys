<?php

use Illuminate\Database\Seeder;

class RTaxTableProfilesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('r_tax_table_profiles')->delete();
        \DB::table('r_tax_table_profiles')->insert(array (
            0 =>
                array (
                    'TAXP_ID' => 1,
                    'TAXP_NAME' => 'VAT@12',
                    'TAXP_DESC' => 'VALUE ADDED TAX AT 12 PERCENT',
                    'TAXP_RATE' => 12.0,
                    'TAXP_TYPE' => 0,
                    'TAXP_DISPLAY_STATUS' => 1,
                    'created_at' => '2019-02-28 04:21:11',
                    'updated_at' => '2019-02-28 04:21:11',
                ),
            1 =>
                array (
                    'TAXP_ID' => 2,
                    'TAXP_NAME' => 'VAT@ 10',
                    'TAXP_DESC' => 'VALUE ADDED TAX AT 10 PERCENT',
                    'TAXP_RATE' => 10.0,
                    'TAXP_TYPE' => 0,
                    'TAXP_DISPLAY_STATUS' => 1,
                    'created_at' => '2019-02-28 04:21:47',
                    'updated_at' => '2019-02-28 04:21:47',
                ),
        ));



    }
}
