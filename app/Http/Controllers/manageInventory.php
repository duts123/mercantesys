<?php

namespace App\Http\Controllers;

use App\Providers\sympiesProvider;
use App\r_inventory_info;
use App\r_product_info;
use App\t_product_variance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;
use Illuminate\Support\Facades\Auth;


class manageInventory extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $prodInfo = r_product_info::all();
        (Auth::user()->role=='admin')?'':$prodInfo=$prodInfo->where('AFF_ID',Auth::user()->AFF_ID);

        $inventory = sympiesProvider::returnProdInventory();
        $inventory = $inventory->whereIn('PROD_ID',$prodInfo->pluck('PROD_ID')->toArray());

        return view('pages.inventory.table-inventory-remaining',compact('inventory'));

    }

    public function manageInventory(Request $request){

        return view('pages.inventory.manage-inventory');
    }

    public function skuInventory($sku,Request $request){
        try {

            $prod = collect(DB::SELECT("
             SELECT 
			PROD.PROD_ID
			,PROD.PROD_NAME 
			,PROD.PROD_DESC
			,PROD.PROD_CODE
			,PROD.PROD_IMG
			,PROD.PROD_CRITICAL 
			,((SELECT IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE (INV.INV_TYPE='CAPITAL' OR INV.INV_TYPE='ADD') AND INV.PROD_ID=PROD.PROD_ID AND ISNULL(INV.PRODV_ID)) 
			+(SELECT IFNULL(SUM(QPROD.PROD_INIT_QTY),0) FROM r_product_infos QPROD WHERE QPROD.PROD_ID = PROD.PROD_ID)) CAPITAL
			,(SELECT IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE INV.INV_TYPE='DISPOSE' AND INV.PROD_ID=PROD.PROD_ID AND ISNULL(INV.PRODV_ID)) DISPOSED
			,(SELECT IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE INV.INV_TYPE='ORDER' AND INV.PROD_ID=PROD.PROD_ID AND ISNULL(INV.PRODV_ID)) 'ORDER'
			,((SELECT IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE (INV.INV_TYPE='CAPITAL' OR INV.INV_TYPE='ADD') AND INV.PROD_ID=PROD.PROD_ID AND ISNULL(INV.PRODV_ID))
			+(SELECT -IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE INV.INV_TYPE='DISPOSE' AND INV.PROD_ID=PROD.PROD_ID AND ISNULL(INV.PRODV_ID))
			+(SELECT -IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE INV.INV_TYPE='ORDER' AND INV.PROD_ID=PROD.PROD_ID AND ISNULL(INV.PRODV_ID)) 
			+(SELECT IFNULL(SUM(PROD_INIT_QTY),0) FROM r_product_infos t_infos WHERE PROD_ID = PROD.PROD_ID)) TOTAL
					FROM r_product_infos PROD WHERE PROD.PROD_CODE = '".$sku."'
             "))->first();

            $prodvar = collect(DB::SELECT("    
        SELECT 
			PRODV.PRODV_ID
			,PRODV.PRODV_NAME
			,PRODV.PRODV_DESC
			,PRODV.PRODV_IMG
			,PRODV.PRODV_INIT_QTY
			,PRODV.PRODV_ADD_PRICE
			,PRODV.PRODV_SKU
			,((SELECT IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE (INV.INV_TYPE='CAPITAL' OR INV.INV_TYPE='ADD') AND INV.PROD_ID=PRODV.PROD_ID AND INV.PRODV_ID = PRODV.PRODV_ID)
					+(SELECT IFNULL(SUM(QPRODV.PRODV_INIT_QTY),0) FROM t_product_variances QPRODV WHERE QPRODV.PROD_ID = PRODV.PROD_ID AND QPRODV.PRODV_ID = PRODV.PRODV_ID)) CAPITAL
			,(SELECT IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE INV.INV_TYPE='DISPOSE' AND INV.PROD_ID=PRODV.PROD_ID AND INV.PRODV_ID = PRODV.PRODV_ID) DISPOSED
			,(SELECT IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE INV.INV_TYPE='ORDER' AND INV.PROD_ID=PRODV.PROD_ID AND INV.PRODV_ID = PRODV.PRODV_ID) 'ORDER'
			,((SELECT IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE (INV.INV_TYPE='CAPITAL' OR INV.INV_TYPE='ADD') AND INV.PROD_ID=PRODV.PROD_ID AND INV.PRODV_ID = PRODV.PRODV_ID)
					+(SELECT -IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE INV.INV_TYPE='DISPOSE' AND INV.PROD_ID=PRODV.PROD_ID AND INV.PRODV_ID = PRODV.PRODV_ID)
					+(SELECT -IFNULL(SUM(INV.INV_QTY),0) FROM r_inventory_infos INV WHERE INV.INV_TYPE='ORDER' AND INV.PROD_ID=PRODV.PROD_ID AND INV.PRODV_ID = PRODV.PRODV_ID)
					+(SELECT IFNULL(SUM(QPRODV.PRODV_INIT_QTY),0) FROM t_product_variances QPRODV WHERE QPRODV.PROD_ID = PRODV.PROD_ID AND QPRODV.PRODV_ID = PRODV.PRODV_ID)) TOTAL  
            FROM t_product_variances PRODV WHERE PRODV.PROD_ID = $prod->PROD_ID "));
        }catch(\Exception $e){
            return abort('404');
        }

        return view('pages.inventory.sku-inventory',compact('prod','prodvar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function productAcquire(Request $request){
        $inv = new r_inventory_info();

        $inv->PROD_ID = $request->PROD_ID;
        $inv->INV_QTY = $request->qty;
        $inv->INV_TYPE = 'ADD';
        $inv->save();

        return redirect()->back();

    }
    public function productDispose(Request $request){
        $inv = new r_inventory_info();

        $inv->PROD_ID = $request->PROD_ID;
        $inv->INV_QTY = $request->qty;
        $inv->INV_TYPE = 'DISPOSE';
        $inv->save();

        return redirect()->back();

    }

    public function productVAcquire(Request $request){
        $inv = new r_inventory_info();

        $inv->PROD_ID = $request->PROD_ID;
        $inv->PRODV_ID = $request->PRODV_ID;
        $inv->INV_QTY = $request->qty;
        $inv->INV_TYPE = 'ADD';
        $inv->save();

        return redirect()->back();

    }
    public function productVDispose(Request $request){
        $inv = new r_inventory_info();

        $inv->PROD_ID = $request->PROD_ID;
        $inv->PRODV_ID = $request->PRODV_ID;
        $inv->INV_QTY = $request->qty;
        $inv->INV_TYPE = 'DISPOSE';
        $inv->save();

        return redirect()->back();

    }
}
