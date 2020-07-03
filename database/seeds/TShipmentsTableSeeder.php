<?php

use Illuminate\Database\Seeder;

class TShipmentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('t_shipments')->delete();
        
        \DB::table('t_shipments')->insert(array (
            0 => 
            array (
                'SHIP_ID' => 4,
                'ORD_ID' => 10,
                'INV_ID' => 5,
                'SHIP_TRACKING_NO' => 'SHIP-5c756452e6bc1',
                'SHIP_DESC' => 'The item will be delivered soon',
                'created_at' => '2019-02-26 16:07:46',
                'updated_at' => '2019-02-26 16:07:46',
            ),
            1 => 
            array (
                'SHIP_ID' => 6,
                'ORD_ID' => 12,
                'INV_ID' => 7,
                'SHIP_TRACKING_NO' => 'SHIP-5c75796b89244',
                'SHIP_DESC' => 'The item will be delivered soon',
                'created_at' => '2019-02-26 17:37:47',
                'updated_at' => '2019-02-26 17:37:47',
            ),
            2 => 
            array (
                'SHIP_ID' => 7,
                'ORD_ID' => 13,
                'INV_ID' => 8,
                'SHIP_TRACKING_NO' => 'SHIP-5c7579d98f187',
                'SHIP_DESC' => 'The item will be delivered soon',
                'created_at' => '2019-02-26 17:39:37',
                'updated_at' => '2019-02-26 17:39:37',
            ),
        ));
        
        
    }
}