<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'John Patrick Loyola',
                'email' => 'loyolapat04@gmail.com',
                'password' => '$2y$10$Db7L7QsQJIFOB2uZ8c1UA.9cY17t.mJ6lBNBSLYaRqFeJTnXIDEYK',
                'role' => 'admin',
                'AFF_ID' => 1,
                'remember_token' => NULL,
                'USER_DisplayStat' => 1,
                'created_at' => '2019-02-19 05:43:41',
                'updated_at' => '2019-02-19 05:43:41',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Cristina - Island Rose',
                'email' => 'islandrose@gmail.com',
                'password' => '$2y$10$A9/5NAMx3UxL9/jxAuTgCe.9FNSyJBjoHFB93QGD.RXVkKfz421am',
                'role' => 'member',
                'AFF_ID' => 2,
                'remember_token' => NULL,
                'USER_DisplayStat' => 1,
                'created_at' => '2019-02-19 05:43:41',
                'updated_at' => '2019-02-19 05:43:41',
            ),
        ));
        
        
    }
}