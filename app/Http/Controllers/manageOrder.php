<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use vakata\database\Exception;
use App\Providers\sympiesProvider as Sympies;
use App\r_inventory_info;
use App\t_invoice;
use App\r_product_info;
use App\t_order;
use App\t_order_item;
use App\t_payment;
use App\t_product_variance;
use App\t_shipment;
use App\t_shipment_orderitem;
use App\r_product_type;
use App\r_tax_table_profile;

use App\r_affiliate_info;
use Redirect;
use Session;
use URL;
class manageOrder extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function evaluateReceipt()
    {
        $request = \Request::capture();
        \DB::Table('t_orders')->where('ORD_ID',$request->order_id)
            ->update([
                'ORD_STATUS'=>$request->status
            ]);
    }

    public function uploadPaymentReceipt()
    {

        $request = \Request::capture();
        $path = '';
        $ereceipts = $request->file('ORD_PAYMENT_RECEIPT');
        if($ereceipts!=null)
        {
            $ereceipts->move(public_path('uploads/receipts'),$ereceipts->getClientOriginalName());  
            $ereceipt_name = $ereceipts->getClientOriginalName();
        }
        else 
        {
            $ereceipt_name = "";
            $path = $ereceipt_name;
        }
        $path = 'uploads/receipts/'.$ereceipt_name;
        \DB::Table('t_orders')->where('ORD_ID',$request->ORD_ID)
        ->update([
            'ORD_STATUS'=>$request->ORD_STATUS,
            'ORD_PAYMENT_RECEIPT'=> $path
        ]);

        return redirect()->route('summary-orders');
    }

    public function addOrders()
    {
            $request = \Request::capture();
            $prodID = $request->prodID;
            $prodvID = $request->prodvID;
            $qty = $request->qty;
            $percentage = (Sympies::active_currency()->rTaxTableProfile->TAXP_TYPE==0)?Sympies::active_currency()->rTaxTableProfile->TAXP_RATE:0;
            $fixed = (Sympies::active_currency()->rTaxTableProfile->TAXP_TYPE==1)?Sympies::active_currency()->rTaxTableProfile->TAXP_RATE:0;
            $currency = Sympies::active_currency()->CURR_ACR;
            $delivery = Sympies::active()->SET_DEL_CHARGE;
            $invoice = uniqid('SYMPIES-');

            $sku = '';
            $saletax = 0;
            $subtotal=0;
            $aff_id = \DB::Table('r_product_infos')->where('PROD_ID',$prodID)->value('AFF_ID');
            if($prodvID==0){
                $getProd = r_product_info::with('rAffiliateInfo','rProductType')
                    ->where('PROD_IS_APPROVED','1')
                    ->where('PROD_DISPLAY_STATUS',1)
                    ->where('PROD_ID',$prodID)
                    ->first();
                $prodCode = $getProd->PROD_CODE;
                $prodDesc = $getProd->PROD_DESC;
                $prodPrice = $getProd->PROD_MY_PRICE;
                $discount = $getProd->PROD_DISCOUNT;
                $prodName = $getProd->PROD_NAME;
                $prodImg = $getProd->PROD_IMG;
                $priceDiscounted = ($discount)?$prodPrice-($prodPrice*($discount/100)):$prodPrice;

            }else{
                $getProdv = t_product_variance::with('rProductInfo')
                    ->where('PROD_ID',$prodID)
                    ->where('PRODV_ID',$prodvID)
                    ->first();

                $prodCode = $getProdv->PRODV_SKU;
                $prodDesc = $getProdv->PRODV_DESC;
                $discount = $getProdv->rProductInfo->PROD_DISCOUNT;
                $prodPrice = $getProdv->PRODV_ADD_PRICE + $getProdv->rProductInfo->PROD_MY_PRICE;
                $prodName = $getProdv->PRODV_NAME;
                $prodImg = $getProdv->PRODV_IMG;
                $priceDiscounted = ($discount)?$prodPrice-($prodPrice*($discount/100)):$prodPrice;

            }

            $subtotal = $priceDiscounted *$qty;
            $saletax = (!$fixed)?($subtotal * ($percentage/100)):$subtotal+$fixed;

            
            $product = \DB::Table("r_product_infos")->where("PROD_ID",$prodID)->get();
            $transcode= uniqid('TRANSACT-');
            

            $sympiesCred = Session::get('sympiesAccount');
            $transcode= uniqid('TRANSACT-');
            $invoice= uniqid('SYMPIES-');
            $ord_id = t_order::max('ORD_ID')+1;
            $ordi_id = t_order_item::max('ORDI_ID')+1;
            $inv_id = t_invoice::max('INV_ID')+1;
            $ship_id = t_shipment::max('SHIP_ID')+1;
            $shipordi = t_shipment_orderitem::max('SHIPORDI_ID')+1;
            $inven_id = r_inventory_info::max('INV_ID')+1;
            $order = new t_order();
            //$order->ORD_FROM_SYMPIES_ID = $sympiesCred['ID'];
            $order->ORD_ID = $ord_id;
            $order->SYMPIES_ID = $sympiesCred['ID'];
            $order->ORD_SYMP_TRANS_CODE = $transcode;
            $order->ORD_FROM_NAME = Session::get('sympiesAccount')['NAME'];
            $order->ORD_FROM_EMAIL = $sympiesCred['EMAIL'];
            $order->ORD_FROM_CONTACT = $sympiesCred['CONTACT_NO'];
            $order->ORD_TO_EMAIL = $request->to_email;
            $order->ORD_TO_CONTACT = $request->to_contact;
            $order->ORD_HOUSE_NO = $request->houseno;
            $order->ORD_STREET = $request->street;
            $order->ORD_BARANGAY = $request->barangay;
            $order->ORD_CITY = $request->city;
            $order->ORD_DISCOUNT = $priceDiscounted;
            $order->ORD_STATUS = 'Pending';
            $order->ORD_COMPLETE = Carbon::now();
            $order->AFF_ID = $aff_id;
            $order->save();


            $orderi = new t_order_item();
            $orderi->ORDI_ID = $ordi_id;
            $orderi->ORD_ID = $ord_id;
            $orderi->PROD_ID = $prodID;
            $orderi->ORDI_QTY = $request->qty;
            $orderi->ORDI_NOTE = $request->prodnote;
            $orderi->PROD_NAME = $prodName;
            $orderi->PROD_SKU = $prodCode;
         
            $orderi->PROD_DESC = $prodDesc;
            $orderi->ORDI_SOLD_PRICE = $subtotal;
            $orderi->PROD_MY_PRICE = $prodPrice;
            $orderi->save();

            $invoices = new t_invoice();
            $invoices->INV_ID = $inv_id;
            $invoices->INV_NO = $invoice;
            $invoices->ORD_ID = $ord_id;
            $invoices->INV_STATUS = 'pending';
            $invoices->INV_DETAILS = 'Thank you for purchasing on SympiesShop';
            $invoices->save();

            

            $shipment = new t_shipment();
            $shipment->SHIP_ID = $ship_id;
            $shipment->SHIP_TRACKING_NO = uniqid('SHIP-');
            $shipment->ORD_ID = $ord_id;
            $shipment->INV_ID = $inv_id;
            $shipment->SHIP_STATUS = 'pending';
            $shipment->SHIP_DESC = 'The item will delivered soon';
            $shipment->save();

            
            \DB::Table('t_shipment_orderitems')
            ->insert([
                'SHIPORDI_ID'=>$shipordi,
                'SHIP_ID'=>$ship_id,
                'ORDI_ID'=>$ordi_id,
                'created_at'=>\DB::raw('CURRENT_TIMESTAMP')
            ]);

            $inventory = new r_inventory_info();
            $inventory->INV_ID = $inven_id;
            $inventory->ORDI_ID = $ordi_id;
            $inventory->PRODV_ID = ($prodvID != 0) ? $prodvID : null;
            $inventory->PROD_ID = $prodID;
            $inventory->INV_QTY = $request->qty;
            $inventory->INV_TYPE = 'ORDER';
            $inventory->save();


            $order_details = array(
                'ord_id'=>$ord_id,
                'transcode'=>$transcode,
                'invoice'=>$invoice,
                'prodName'=>$prodName,
                'prodDesc'=>$prodDesc,
                'subtotal'=>$subtotal,
                'prodImg'=>$prodImg
            );
            Session::put('order_details', $order_details);
            return redirect()->route('checkoutView');

    }
    public function checkoutView()
    {
        $order_details = Session::get('order_details');
        $Allprod = Sympies::filterAvailable(r_product_info::with('rAffiliateInfo', 'rProductType')
        ->where('PROD_IS_APPROVED', '1')
        ->where('PROD_DISPLAY_STATUS', 1)->get());
        $aff = r_affiliate_info::where('AFF_DISPLAY_STATUS',1)->get();
        $cat = r_product_type::with('rProductType')->where('PRODT_DISPLAY_STATUS',1)->get();

        return view('pages.frontend-shop.checkout',compact('Allprod','aff','cat','order_details'));
    }
    public function index()
    {   $id = Auth::user()->id;
        $order = t_order::where('AFF_ID',$id)->get();
        $order_item = \DB::Table("v_order_item")
            ->where('AFF_ID',$id)
            ->get();
        return view('pages.orders.table-orders',compact('order','order_item'));
    }

    public function userInvoice($id)
    {
        // $order = \App\t_order::where('ORD_ID',$id)
        // ->first();

        // $order_items = \App\t_order_item::with('tOrder','rProductInfo')
        // ->where('ORD_ID',$order->ORD_ID)
        // ->get();

        $user_id = Auth::user()->id;
        $order = t_order::where('AFF_ID',$user_id)->where('ORD_ID',$id)->first();
        $order_items = \DB::Table("v_order_item")
            ->where('AFF_ID',$user_id)
            ->where('ORD_ID',$id)
            ->get();

        $invoice = \App\t_invoice::with('tOrder')
        ->where('ORD_ID',$id)
        ->first();

        $shipment = \App\t_shipment::with('tInvoice','tOrder')
        ->where('ORD_ID',$id)
        ->first();

        // dd($order);
        // $payment = \App\t_payment::with('tInvoice')
        // ->where('INV_ID',$invoice->INV_ID)
        // ->first();
        return view('pages.invoices.user-invoice'
        ,compact('order','order_items','invoice','shipment'));

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
        $type =$request->type;
        $id = $request->id;
        $ids=$request->ids;

            if($type==1){
                foreach($ids as $id){
                    $order = t_order::where('ORD_ID',$id)->first();
                    $order->ORD_STATUS = 'Completed';
                    $order->ORD_COMPLETE = Carbon::now();
                    $order->ORD_CANCELLED = NULL;
                    $order->updated_at = Carbon::now();
                    $order->save();

                    $inv = t_invoice::where('ORD_ID',$id)->first();
                    $inv->INV_STATUS = 'Completed';
                    $inv->updated_at = Carbon::now();
                    $inv->save();

                    $pay = t_payment::where('INV_ID',$inv->INV_ID)->first();
                    $pay->PAY_CAPTURED_AT = Carbon::now();
                    $pay->updated_at = Carbon::now();
                    $pay->save();
                }
            }else if($type==2){
                foreach($ids as $id){
                    $order = t_order::where('ORD_ID',$id)->first();
                    $order->ORD_STATUS = 'Void';
                    $order->ORD_COMPLETE = NULL;
                    $order->ORD_CANCELLED = NULL;
                    $order->updated_at = Carbon::now();
                    $order->save();

                    $inv = t_invoice::where('ORD_ID',$id)->first();
                    $inv->INV_STATUS = 'Void';
                    $inv->updated_at = Carbon::now();
                    $inv->save();

                    $pay = t_payment::where('INV_ID',$inv->INV_ID)->first();
                    $pay->PAY_CAPTURED_AT = NULL;
                    $pay->updated_at = Carbon::now();
                    $pay->save();

                }
            }else if($type==3){
                $order = t_order::where('ORD_ID',$id)->first();
                $order->ORD_STATUS = 'Refunded';
                $order->ORD_COMPLETE = NULL;
                $order->ORD_CANCELLED = NULL;
                $order->updated_at = Carbon::now();
                $order->save();

                $inv = t_invoice::where('ORD_ID',$id)->first();
                $inv->INV_STATUS = 'Refunded';
                $inv->updated_at = Carbon::now();
                $inv->save();

                $pay = t_payment::where('INV_ID',$inv->INV_ID)->first();
                $pay->PAY_CAPTURED_AT = NULL;
                $pay->updated_at = Carbon::now();
                $pay->save();
            }else if($type==4){
                $order = t_order::where('ORD_ID',$id)->first();
                $order->ORD_STATUS = 'Void';
                $order->ORD_COMPLETE = NULL;
                $order->ORD_CANCELLED = NULL;
                $order->updated_at = Carbon::now();
                $order->save();

                $inv = t_invoice::where('ORD_ID',$id)->first();
                $inv->INV_STATUS = 'Void';
                $inv->updated_at = Carbon::now();
                $inv->save();

                $pay = t_payment::where('INV_ID',$inv->INV_ID)->first();
                $pay->PAY_CAPTURED_AT = NULL;
                $pay->updated_at = Carbon::now();
                $pay->save();

            }else if($type==5){
                $order = t_order::where('ORD_ID',$id)->first();
                $order->ORD_STATUS = 'Completed';
                $order->ORD_COMPLETE = Carbon::now();
                $order->ORD_CANCELLED = NULL;
                $order->updated_at = Carbon::now();
                $order->save();


                $inv = t_invoice::where('ORD_ID',$id)->first();
                $inv->INV_STATUS = 'Completed';
                $inv->updated_at = Carbon::now();
                $inv->save();

                $pay = t_payment::where('INV_ID',$inv->INV_ID)->first();
                $pay->PAY_CAPTURED_AT = Carbon::now();
                $pay->updated_at = Carbon::now();
                $pay->save();

            }else if($type==6){
                $order = t_order::where('ORD_ID',$id)->first();
                $order->ORD_STATUS = 'Cancelled';
                $order->ORD_COMPLETE = NULL;
                $order->ORD_CANCELLED = Carbon::now();
                $order->updated_at = Carbon::now();
                $order->save();

                $inv = t_invoice::where('ORD_ID',$id)->first();
                $inv->INV_STATUS = 'Cancelled';
                $inv->updated_at = Carbon::now();
                $inv->save();

                $pay = t_payment::where('INV_ID',$inv->INV_ID)->first();
                $pay->PAY_CAPTURED_AT = NULL;
                $pay->updated_at = Carbon::now();
                $pay->save();

            }else if($type==6.1){
                $order = t_order::where('ORD_ID',$id)->first();
                $order->ORD_STATUS = 'Pending';
                $order->ORD_COMPLETE = NULL;
                $order->ORD_CANCELLED = NULL;
                $order->updated_at = Carbon::now();
                $order->save();


                $inv = t_invoice::where('ORD_ID',$id)->first();
                $inv->INV_STATUS = 'Pending';
                $inv->updated_at = Carbon::now();
                $inv->save();


            }else if($type==3.1){
                $order = t_order::where('ORD_ID',$id)->first();
                $order->ORD_STATUS = 'Pending';
                $order->ORD_COMPLETE = NULL;
                $order->ORD_CANCELLED = NULL;
                $order->updated_at = Carbon::now()  ;
                $order->save();

                $inv = t_invoice::where('ORD_ID',$id)->first();
                $inv->INV_STATUS = 'Pending';
                $inv->updated_at = Carbon::now();
                $inv->save();

            }

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


}
