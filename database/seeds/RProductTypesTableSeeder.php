<?php

use Illuminate\Database\Seeder;

class RProductTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('r_product_types')->delete();
        
        \DB::table('r_product_types')->insert(array (
            0 => 
            array (
                'PRODT_ID' => 1,
                'PRODT_TITLE' => 'Food',
                'PRODT_DESC' => 'Description',
                'PRODT_PARENT' => NULL,
                'PRODT_DISPLAY_STATUS' => 1,
                'created_at' => '2019-02-19 05:43:43',
                'updated_at' => '2019-02-19 05:43:43',
            ),
            1 => 
            array (
                'PRODT_ID' => 2,
                'PRODT_TITLE' => 'Flowers',
                'PRODT_DESC' => 'Description',
                'PRODT_PARENT' => NULL,
                'PRODT_DISPLAY_STATUS' => 1,
                'created_at' => '2019-02-19 05:43:43',
                'updated_at' => '2019-02-19 05:43:43',
            ),
            2 => 
            array (
                'PRODT_ID' => 3,
                'PRODT_TITLE' => 'Chocolates',
                'PRODT_DESC' => 'Description',
                'PRODT_PARENT' => NULL,
                'PRODT_DISPLAY_STATUS' => 1,
                'created_at' => '2019-02-19 05:43:43',
                'updated_at' => '2019-02-19 05:43:43',
            ),
            3 => 
            array (
                'PRODT_ID' => 4,
                'PRODT_TITLE' => 'Almond Chocolate',
                'PRODT_DESC' => 'Description',
                'PRODT_PARENT' => 3,
                'PRODT_DISPLAY_STATUS' => 1,
                'created_at' => '2019-02-19 05:43:43',
                'updated_at' => '2019-02-19 05:43:43',
            ),
            4 => 
            array (
                'PRODT_ID' => 5,
                'PRODT_TITLE' => 'Chocolates and Flowers',
                'PRODT_DESC' => 'Description',
                'PRODT_PARENT' => 2,
                'PRODT_DISPLAY_STATUS' => 1,
                'created_at' => '2019-02-19 05:43:43',
                'updated_at' => '2019-02-22 01:07:04',
            ),
            5 => 
            array (
                'PRODT_ID' => 6,
                'PRODT_TITLE' => 'Flowers Bouquet',
                'PRODT_DESC' => 'Description',
                'PRODT_PARENT' => 2,
                'PRODT_DISPLAY_STATUS' => 1,
                'created_at' => '2019-02-19 05:43:43',
                'updated_at' => '2019-02-19 05:43:43',
            ),
            6 => 
            array (
                'PRODT_ID' => 7,
                'PRODT_TITLE' => 'Fruit Salad',
                'PRODT_DESC' => 'Description',
                'PRODT_PARENT' => 1,
                'PRODT_DISPLAY_STATUS' => 0,
                'created_at' => '2019-02-19 05:43:43',
                'updated_at' => '2019-02-22 00:42:59',
            ),
            7 => 
            array (
                'PRODT_ID' => 8,
                'PRODT_TITLE' => 'Stuffed toys',
                'PRODT_DESC' => 'Stuffed toys Description',
                'PRODT_PARENT' => NULL,
                'PRODT_DISPLAY_STATUS' => 1,
                'created_at' => '2019-02-22 00:55:29',
                'updated_at' => '2019-02-22 00:55:29',
            ),
            8 => 
            array (
                'PRODT_ID' => 9,
                'PRODT_TITLE' => 'Teddy Bear with Flowers',
                'PRODT_DESC' => 'Teddy Bear with Flowers Description',
                'PRODT_PARENT' => 8,
                'PRODT_DISPLAY_STATUS' => 1,
                'created_at' => '2019-02-22 00:56:24',
                'updated_at' => '2019-02-22 00:56:24',
            ),
            9 => 
            array (
                'PRODT_ID' => 10,
                'PRODT_TITLE' => 'Chocolate Collection',
                'PRODT_DESC' => 'Chocolate Collection Description',
                'PRODT_PARENT' => 3,
                'PRODT_DISPLAY_STATUS' => 1,
                'created_at' => '2019-02-22 01:09:15',
                'updated_at' => '2019-02-22 01:09:15',
            ),
            10 => 
            array (
                'PRODT_ID' => 11,
                'PRODT_TITLE' => 'Bear',
                'PRODT_DESC' => 'Bear Description',
                'PRODT_PARENT' => 8,
                'PRODT_DISPLAY_STATUS' => 1,
                'created_at' => '2019-02-22 01:27:10',
                'updated_at' => '2019-02-22 01:27:10',
            ),
        ));
        
        
    }
}