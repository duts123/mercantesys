<?php

namespace App\Http\Controllers;

use App\Providers\sympiesProvider;
use App\r_account_credential;
use App\t_order;
use App\t_order_item;
use App\t_product_variance;
use App\user;
use Illuminate\Http\Request;
use App\r_product_info;
use App\r_affiliate_info;
use App\r_product_type;
use Session;

class frontProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Allprod = sympiesProvider::filterAvailable(r_product_info::with('rAffiliateInfo', 'rProductType')
            ->where('PROD_IS_APPROVED', '1')
            ->where('PROD_DISPLAY_STATUS', 1)->get());
        $aff = r_affiliate_info::where('AFF_DISPLAY_STATUS',1)->get();

        $cat = r_product_type::with('rProductType')->where('PRODT_DISPLAY_STATUS',1)->get();

            $Allprod = sympiesProvider::format($Allprod);
            return view('pages.frontend-shop.list-front-products', compact('Allprod', 'aff', 'cat'));

         // \DB::TABLE('users')
         //  ->WHERE('email', 'islandrose@gmail.com')
         //    ->UPDATE([
         //        'password' => bcrypt('member')
         //    ]);
         //    return "sucess";
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

    public function search(Request $request){
        $search = $request->get('search');
        $price_from = ($request->get('price_from'))?
            $request->get('price_from'):0;
        $price_to = ($request->get('price_to'))?
            $request->get('price_to'):5000;

        $Allprod = sympiesProvider::filterAvailable(r_product_info::with('rAffiliateInfo', 'rProductType')
            ->where('PROD_IS_APPROVED', '1')
            ->where('PROD_DISPLAY_STATUS', 1)->get());

        $searchResult =sympiesProvider::filterAvailable(r_product_info::with('rAffiliateInfo', 'rProductType')
            ->orWhere('PROD_NAME','like','%'.$search.'%')
            ->orWhere('PROD_DESC','like','%'.$search.'%')
            ->get());

        $Allprod = sympiesProvider::format($Allprod);
        $searchResult = collect(sympiesProvider::format($searchResult))
            ->where('UNFORMAT_PRICE','>=',$price_from)
            ->where('UNFORMAT_PRICE','<=',$price_to);
        $aff = r_affiliate_info::where('AFF_DISPLAY_STATUS',1)->get();

        $cat = r_product_type::with('rProductType')->where('PRODT_DISPLAY_STATUS',1)->get();


        return view('pages.frontend-shop.product-search',compact('search','Allprod','searchResult','aff','cat','price_from','price_to'));

    }
    public function getProdAffiliates(){
        // sympiesProvider::filterAvailable(r_product_info::with('rAffiliateInfo', 'rProductType')
        $request = \Request::capture();
        if($request->id!=0) {

            $Allprod = \DB::Table("v_products_affiliate")
                ->where('PROD_IS_APPROVED', 1)
                ->where('PROD_DISPLAY_STATUS', 1)
                ->where('AFF_ID', $request->id)
                ->get();
            // dd($Allprod);
        }
        else {
             $Allprod = sympiesProvider::filterAvailable(r_product_info::with('rAffiliateInfo', 'rProductType')
            ->where('PROD_IS_APPROVED', '1')
            ->where('PROD_DISPLAY_STATUS', 1)
            ->get());
        }
           

        $Allprod = sympiesProvider::format($Allprod);
        return json_encode($Allprod);

    }


    public function getProdCategory(){
        $request = \Request::capture();
        if($request->id!=0) {
            $Allprod = sympiesProvider::filterAvailable(r_product_info::with('rProductType', 'rAffiliateInfo')
                ->where('PROD_IS_APPROVED', '1')
                //->where('PROD_DISPLAY_STATUS', 1)
                ->where('PRODT_ID', $request->id)
                ->get());
        }
        else {
             $Allprod = sympiesProvider::filterAvailable(r_product_info::with('rProductType', 'rAffiliateInfo')
            ->where('PROD_IS_APPROVED', 1)
            //->where('PROD_DISPLAY_STATUS', 1)
            ->get());
        }
           

        $Allprod = sympiesProvider::format($Allprod);
        return json_encode($Allprod);
    }


    public function getProdDetails($id){

        $Allprod = sympiesProvider::filterAvailable(r_product_info::with('rAffiliateInfo','rProductType')
            ->where('PROD_IS_APPROVED','1')
            ->where('PROD_DISPLAY_STATUS',1)
            ->get());


        $randProd = sympiesProvider::filterAvailable(r_product_info::with('rAffiliateInfo','rProductType')
            ->where('PROD_IS_APPROVED','1')
            ->where('PROD_DISPLAY_STATUS',1)
            ->inRandomOrder()->get());

        $getProd = sympiesProvider::filterAvailable(r_product_info::with('rAffiliateInfo','rProductType')
            ->where('PROD_IS_APPROVED','1')
            ->where('PROD_DISPLAY_STATUS',1)
            ->where('PROD_ID',$id)
            ->get());

        $getVar = t_product_variance::all()
            ->where('PROD_ID',$id);

        $aff = r_affiliate_info::all();
        $cat = r_product_type::with('rProductType')->get();

        $sympiesUser = r_account_credential::all();

        $Allprod = sympiesProvider::format($Allprod);
        $randProd = sympiesProvider::format($randProd);
        $getProd = sympiesProvider::format($getProd);
        return view('pages.frontend-shop.product-details',compact('Allprod','aff','cat','randProd','getProd','getVar','id','sympiesUser'));
    }


    public function getOrders(){
        $get = Session::get('sympiesAccount');
        $Allprod = sympiesProvider::filterAvailable(r_product_info::with('rAffiliateInfo','rProductType')
            ->where('PROD_IS_APPROVED','1')
            ->where('PROD_DISPLAY_STATUS',1)
            ->get());

        $Allprod = sympiesProvider::format($Allprod);

        $order = t_order::where('SYMPIES_ID',$get['ID'])->get();
        $order_item = \DB::Table("v_order_item")
            ->where('SYMPIES_ID',$get['ID'])
            ->get();
        
        // dd($order);
        return view('pages.frontend-shop.user-manage-orders',compact('Allprod','order','order_item'));
    }



}
