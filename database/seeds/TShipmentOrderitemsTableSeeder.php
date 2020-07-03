<?php

use Illuminate\Database\Seeder;

class TShipmentOrderitemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('t_shipment_orderitems')->delete();
        
        \DB::table('t_shipment_orderitems')->insert(array (
            0 => 
            array (
                'SHIPORDI_ID' => 1,
                'SHIP_ID' => 4,
                'ORDI_ID' => 7,
                'created_at' => '2019-02-26 16:07:46',
                'updated_at' => '2019-02-26 16:07:46',
            ),
            1 => 
            array (
                'SHIPORDI_ID' => 3,
                'SHIP_ID' => 6,
                'ORDI_ID' => 9,
                'created_at' => '2019-02-26 17:37:47',
                'updated_at' => '2019-02-26 17:37:47',
            ),
            2 => 
            array (
                'SHIPORDI_ID' => 4,
                'SHIP_ID' => 7,
                'ORDI_ID' => 10,
                'created_at' => '2019-02-26 17:39:37',
                'updated_at' => '2019-02-26 17:39:37',
            ),
        ));
        
        
    }
}