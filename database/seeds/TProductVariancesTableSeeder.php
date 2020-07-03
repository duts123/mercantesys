<?php

use Illuminate\Database\Seeder;

class TProductVariancesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('t_product_variances')->delete();
        
        \DB::table('t_product_variances')->insert(array (
            0 => 
            array (
                'PRODV_ID' => 6,
                'PROD_ID' => 1,
                'PRODV_NAME' => 'Red Flowers',
                'PRODV_SKU' => '2019-ISL-00002-1-REDzis',
                'PRODV_DESC' => 'Red Flowers',
                'PRODV_INIT_QTY' => 20,
                'PRODV_ADD_PRICE' => 29.0,
                'PRODV_IMG' => 'uploads/PROD_VARIANCE1-0.jpg',
                'created_at' => '2019-02-21 05:07:03',
                'updated_at' => '2019-02-21 05:07:03',
            ),
            1 => 
            array (
                'PRODV_ID' => 7,
                'PROD_ID' => 11,
                'PRODV_NAME' => 'Dark Bear',
                'PRODV_SKU' => '2019-SYM-00001-11-DARvnv',
                'PRODV_DESC' => 'Dark Bear',
                'PRODV_INIT_QTY' => 10,
                'PRODV_ADD_PRICE' => 10.0,
                'PRODV_IMG' => 'uploads/PROD_VARIANCE11-1.jpg',
                'created_at' => '2019-02-22 01:31:07',
                'updated_at' => '2019-02-22 04:04:36',
            ),
        ));
        
        
    }
}