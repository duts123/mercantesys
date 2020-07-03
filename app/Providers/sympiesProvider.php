<?php

namespace App\Providers;

use App\r_currencies;
use App\t_setup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use vakata\database\Exception;
use Illuminate\Support\Facades\DB;

class sympiesProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public static function returnProdInventory(){
        $inventory = collect(DB::SELECT("SELECT 
			PROD.PROD_ID
			,PROD.PROD_NAME 
			,PROD.PROD_DESC
			,PROD.PROD_CODE
			,PROD.PROD_IMG
			,PROD.PROD_CRITICAL 
			,((SELECT IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE (INV.INV_TYPE='CAPITAL' OR INV.INV_TYPE='ADD') AND INV.PROD_ID=PROD.PROD_ID)
					+(SELECT IFNULL(SUM(PRODV.PRODV_INIT_QTY),0) FROM t_product_variances PRODV WHERE PRODV.PROD_ID = PROD.PROD_ID)
					+(SELECT IFNULL(SUM(QPROD.PROD_INIT_QTY),0) FROM r_product_infos QPROD WHERE QPROD.PROD_ID = PROD.PROD_ID)) CAPITAL
			,(SELECT IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE INV.INV_TYPE='DISPOSE' AND INV.PROD_ID=PROD.PROD_ID) DISPOSED
			,(SELECT IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE INV.INV_TYPE='ORDER' AND INV.PROD_ID=PROD.PROD_ID) 'ORDER'
			,((SELECT IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE (INV.INV_TYPE='CAPITAL' OR INV.INV_TYPE='ADD') AND INV.PROD_ID=PROD.PROD_ID)
					+(SELECT -IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE INV.INV_TYPE='DISPOSE' AND INV.PROD_ID=PROD.PROD_ID)
					+(SELECT -IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE INV.INV_TYPE='ORDER' AND INV.PROD_ID=PROD.PROD_ID)
					+(SELECT IFNULL(SUM(PRODV.PRODV_INIT_QTY),0) FROM t_product_variances PRODV WHERE PRODV.PROD_ID = PROD.PROD_ID)
					+(SELECT IFNULL(SUM(PROD_INIT_QTY),0) FROM r_product_infos
					t_infos WHERE PROD_ID = PROD.PROD_ID)) TOTAL
					FROM r_product_infos PROD
					"));
            return $inventory;
    }
    public static  function isAvailable ($val){
        $start = "";
        $end = "";
        if(isset($val)){
            try{
                $dates = explode('to',$val);

                $start = strtotime(trim($dates[0]));
                $end = strtotime(trim($dates[1]));

                if(strtotime(date("m/d/Y")) >= $start && strtotime(date("m/d/Y")) <= $end)
                    return 1;
                return 0;


            }catch (Exception $e){
                return 0;
            }
        }
        return 1;

    }

    public static function filterAvailable($final){
        $Allprod = collect();
        foreach ($final as $item) {

            if (sympiesProvider::isAvailable($item->PROD_AVAILABILITY) == 1) {
                $Allprod->push($item);
            }

        }
        return $Allprod;
    }


    public static function active(){
        $active = t_setup::with('rCurrency')->orderByDesc('SET_ID')->first();

        return $active;
    }

    public static function active_currency(){

        return $current = r_currencies::with('rTaxTableProfile')->where('CURR_ID',sympiesProvider::active()->CURR_ID)->first();

    }

    public static function current_price($myprice){

        if($myprice) {
            return sympiesProvider::active_currency()->CURR_SYMBOL . ' ' . $myprice;
        }
        return '';
    }


    public static function format($collection){
        if($collection)

            foreach ($collection as $item){

                $discount = $item->PROD_DISCOUNT;
                $total= $item->PROD_MY_PRICE;

                $unformat_price = (($total!='NAN')?(($discount)?$total-($total*($discount/100)):$total):$total);
                $price = sympiesProvider::current_price(($total!='NAN')?number_format(($discount)?$total-($total*($discount/100)):$total,2):$total);
                $discount_price = sympiesProvider::current_price(($discount)?number_format($total,2):'');

                $item->PRICE = $price;
                $item->UNFORMAT_PRICE = $unformat_price;
                $item->DISCOUNT = $discount_price;


            }

        return $collection;
    }



}
