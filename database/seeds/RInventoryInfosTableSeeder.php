<?php

use Illuminate\Database\Seeder;

class RInventoryInfosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('r_inventory_infos')->delete();
        
        \DB::table('r_inventory_infos')->insert(array (
            0 => 
            array (
                'INV_ID' => 1,
                'PROD_ID' => 1,
                'PRODV_ID' => NULL,
                'INV_QTY' => 10,
                'INV_TYPE' => 'CAPITAL',
                'ORDI_ID' => NULL,
                'created_at' => '2019-02-20 05:46:38',
                'updated_at' => '2019-02-20 05:46:38',
            ),
            1 => 
            array (
                'INV_ID' => 6,
                'PROD_ID' => 5,
                'PRODV_ID' => NULL,
                'INV_QTY' => 100,
                'INV_TYPE' => 'CAPITAL',
                'ORDI_ID' => NULL,
                'created_at' => '2019-02-22 00:59:10',
                'updated_at' => '2019-02-22 00:59:10',
            ),
            2 => 
            array (
                'INV_ID' => 7,
                'PROD_ID' => 6,
                'PRODV_ID' => NULL,
                'INV_QTY' => 100,
                'INV_TYPE' => 'CAPITAL',
                'ORDI_ID' => NULL,
                'created_at' => '2019-02-22 01:00:56',
                'updated_at' => '2019-02-22 01:00:56',
            ),
            3 => 
            array (
                'INV_ID' => 8,
                'PROD_ID' => 7,
                'PRODV_ID' => NULL,
                'INV_QTY' => 100,
                'INV_TYPE' => 'CAPITAL',
                'ORDI_ID' => NULL,
                'created_at' => '2019-02-22 01:02:32',
                'updated_at' => '2019-02-22 01:02:32',
            ),
            4 => 
            array (
                'INV_ID' => 9,
                'PROD_ID' => 8,
                'PRODV_ID' => NULL,
                'INV_QTY' => 100,
                'INV_TYPE' => 'CAPITAL',
                'ORDI_ID' => NULL,
                'created_at' => '2019-02-22 01:05:44',
                'updated_at' => '2019-02-22 01:05:44',
            ),
            5 => 
            array (
                'INV_ID' => 10,
                'PROD_ID' => 9,
                'PRODV_ID' => NULL,
                'INV_QTY' => 100,
                'INV_TYPE' => 'CAPITAL',
                'ORDI_ID' => NULL,
                'created_at' => '2019-02-22 01:07:48',
                'updated_at' => '2019-02-22 01:07:48',
            ),
            6 => 
            array (
                'INV_ID' => 11,
                'PROD_ID' => 10,
                'PRODV_ID' => NULL,
                'INV_QTY' => 100,
                'INV_TYPE' => 'CAPITAL',
                'ORDI_ID' => NULL,
                'created_at' => '2019-02-22 01:10:31',
                'updated_at' => '2019-02-22 01:10:31',
            ),
            7 => 
            array (
                'INV_ID' => 12,
                'PROD_ID' => 11,
                'PRODV_ID' => NULL,
                'INV_QTY' => 100,
                'INV_TYPE' => 'CAPITAL',
                'ORDI_ID' => NULL,
                'created_at' => '2019-02-22 01:29:55',
                'updated_at' => '2019-02-22 01:29:55',
            ),
            8 => 
            array (
                'INV_ID' => 13,
                'PROD_ID' => 11,
                'PRODV_ID' => 7,
                'INV_QTY' => 10,
                'INV_TYPE' => 'CAPITAL',
                'ORDI_ID' => NULL,
                'created_at' => '2019-02-22 01:31:07',
                'updated_at' => '2019-02-22 01:31:07',
            ),
            9 => 
            array (
                'INV_ID' => 14,
                'PROD_ID' => 1,
                'PRODV_ID' => NULL,
                'INV_QTY' => 2,
                'INV_TYPE' => 'ORDER',
                'ORDI_ID' => 7,
                'created_at' => '2019-02-26 16:07:47',
                'updated_at' => '2019-02-26 16:07:47',
            ),
            10 => 
            array (
                'INV_ID' => 16,
                'PROD_ID' => 1,
                'PRODV_ID' => NULL,
                'INV_QTY' => 1,
                'INV_TYPE' => 'ORDER',
                'ORDI_ID' => 9,
                'created_at' => '2019-02-26 17:37:47',
                'updated_at' => '2019-02-26 17:37:47',
            ),
            11 => 
            array (
                'INV_ID' => 17,
                'PROD_ID' => 5,
                'PRODV_ID' => NULL,
                'INV_QTY' => 2,
                'INV_TYPE' => 'ORDER',
                'ORDI_ID' => 10,
                'created_at' => '2019-02-26 17:39:37',
                'updated_at' => '2019-02-26 17:39:37',
            ),
        ));
        
        
    }
}