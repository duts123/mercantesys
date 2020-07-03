<?php

use Illuminate\Database\Seeder;

class TSetupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('t_setups')->delete();
        
        \DB::table('t_setups')->insert(array (
            0 => 
            array (
                'SET_ID' => 1,
                'CURR_ID' => 1,
                'SET_DEL_CHARGE' => 30.0,
                'SET_SERVICE_FEE' => 20.0,
                'created_at' => '2019-02-22 10:09:29',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'SET_ID' => 2,
                'CURR_ID' => 1,
                'SET_DEL_CHARGE' => 20.0,
                'SET_SERVICE_FEE' => 100.0,
                'created_at' => '2019-02-22 10:19:44',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}