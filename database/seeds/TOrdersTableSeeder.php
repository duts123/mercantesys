<?php

use Illuminate\Database\Seeder;

class TOrdersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('t_orders')->delete();
 
        
    }
}