<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call(RAffiliateInfosTableSeeder::class);
        $this->call(RCurrenciesTableSeeder::class);
        $this->call(RInventoryInfosTableSeeder::class);
        $this->call(RProductTypesTableSeeder::class);
        $this->call(RProductInfosTableSeeder::class);
        $this->call(RRegEcommerceTableSeeder::class);
        $this->call(TInvoicesTableSeeder::class);
        $this->call(RTaxTableProfilesTableSeeder::class);
        $this->call(TOrderItemsTableSeeder::class);
        $this->call(TOrdersTableSeeder::class);
        $this->call(TPaymentsTableSeeder::class);
        $this->call(TProductVariancesTableSeeder::class);
        $this->call(TSetupsTableSeeder::class);
        $this->call(TShipmentOrderitemsTableSeeder::class);
        $this->call(TShipmentsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
