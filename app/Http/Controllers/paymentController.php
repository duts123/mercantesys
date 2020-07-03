<?php
namespace App\Http\Controllers;
use App\r_inventory_info;
use App\t_invoice;
use App\t_order;
use App\t_order_item;
use App\t_payment;
use App\t_product_variance;
use App\t_shipment;
use App\t_shipment_orderitem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\Payout;
use PayPal\Api\PayoutItem;
use PayPal\Api\ShippingAddress;
use PayPal\Api\ShippingInfo;
/** All Paypal Details class **/
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Api\Refund;
use Redirect;
use Session;
use URL;
use App\r_product_info;
use App\r_product_type;
use App\r_tax_table_profile;
use App\Providers\sympiesProvider as Sympies;
use App\r_affiliate_info;


class paymentController extends Controller
{
    private $_api_context;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
                $paypal_conf['client_id'],
                $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }


    public function payWithpaypal(Request $request)
    {
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



        $payer = new Payer();
        $amount = new Amount();
        $item_list = new ItemList();
        $details = new Details();
        $redirect_urls = new RedirectUrls();
        $transaction = new Transaction();
        $payment = new Payment();

        //payment
        $payer
            ->setPaymentMethod('paypal');

        //item it should be array, if cart use foreach init Item() in every succeeding item in cart
        $item_1 = new Item();
        $item_1
            ->setName($prodName) /** item name **/
            ->setCurrency($currency)
            ->setQuantity($qty)
            ->setPrice($priceDiscounted) /** unit price **/
            ->setSku($prodCode)
            ->setDescription($prodDesc);

        //item list
        $item_list
            ->setItems(array($item_1));

         //Details
        $details
            ->setShipping($delivery)
            ->setTax($saletax)
            ->setSubtotal($subtotal)
            ->setShippingDiscount('0.00')
            ->setFee('0.00')
            ->setInsurance('0.00')
            ->setGiftWrap('0.00')
            ->setHandlingFee('0.00');

        //amount
        $amount
            ->setCurrency($currency)
            ->setDetails($details)
            ->setTotal($delivery+$saletax+$subtotal );

        //transaction
        $transaction
            ->setAmount($amount)
            ->setItemList($item_list)
            ->setInvoiceNumber($invoice)
            ->setDescription($request->prodnote);

        //redirect url's
        $redirect_urls
            ->setReturnUrl(URL::to('checkout/finished')) /** Specify return URL **/
            ->setCancelUrl(URL::to('/product/details/'.$prodID));

        //set intent *sale *order *authorize
        $payment
            ->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));


        try {
            //create payment
            $payment
                ->create($this->_api_context);

        } catch (\PayPal\Exception\PPConnectionException $ex) {

            if (Config::get('app.debug')) {
                Session::put('error', 'Connection timeout');
                return Redirect::to('/');
            } else {
                Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::to('/');
            }
        }

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        $paypal_details = array(
            'prodID'=>$prodID,
            'prodvID'=>$prodvID,
            'prodName'=>$prodName,
            'prodDesc'=>$prodDesc,
            'prodImg'=>$request->prodIMG,
            'sympiesTo'=>$request->get('recSympies'),
            'paypal_payment_id'=>$payment->getId(),
            'prod_note'=>$request->prodnote,
            'to_email'=>$request->to_email,
            'to_contact'=>$request->to_contact,
            'discount'=>$discount,
            'invoice'=>$invoice,
            'qty'=>$qty,
            'sku'=>$prodCode,
            'price'=>$prodPrice,
            'subtotal'=>$subtotal,
            'salestax'=>$saletax,
            'delivery'=>$delivery,
        );


        Session::put('paypal_details', $paypal_details);

        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        Session::put('error', 'Unknown error occurred');
        return Redirect::to('/');
    }




    public function getPaymentStatus()
    {
        $Allprod = Sympies::filterAvailable(r_product_info::with('rAffiliateInfo', 'rProductType')
            ->where('PROD_IS_APPROVED', '1')
            ->where('PROD_DISPLAY_STATUS', 1)->get());
        $Allprod = Sympies::format($Allprod);

        $paypal_details = Session::get('paypal_details');
        $payment_id =  $paypal_details['paypal_payment_id'];
        Session::forget('paypal_details');

        if($paypal_details) {
            if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
                Session::put('payment_failed', 'Payment failed');
                return Redirect::to('/');
            }
            $payment = Payment::get($payment_id, $this->_api_context);
            $execution = new PaymentExecution();
            $execution->setPayerId(Input::get('PayerID'));


            /**Execute the payment **/
            $result = $payment->execute($execution, $this->_api_context);
            if ($result->getState() == 'approved') {
                $info = $result->getPayer()->getPayerInfo();
                $payment_info = $result->getTransactions()[0]->getRelatedResources()[0]->getSale();
                $transcode= uniqid('TRANSACT-');


                Session::put('payment_success', 'Payment success');
                $sympiesCred = Session::get('sympiesAccount');

                $order = new t_order();
                $order->ORD_FROM_SYMPIES_ID = $sympiesCred['ID'];
                $order->ORD_TO_SYMPIES_ID = $paypal_details['sympiesTo'];
                $order->ORD_SYMP_TRANS_CODE = $transcode;
                $order->ORD_PAY_CODE = $payment_id;
                $order->ORD_TRANS_CODE = $payment_info->id;
                $order->ORD_FROM_NAME = Session::get('sympiesAccount')['NAME'];
                $order->ORD_TO_NAME = $info->getShippingAddress()->recipient_name;
                $order->ORD_FROM_EMAIL = $sympiesCred['EMAIL'];
                $order->ORD_TO_EMAIL = $paypal_details['to_email'];
                $order->ORD_FROM_CONTACT = $sympiesCred['CONTACT_NO'];
                $order->ORD_TO_CONTACT = $paypal_details['to_contact'];
                $order->ORD_TO_ADDRESS = $info->getShippingAddress()->line1
                    . ', ' . $info->getShippingAddress()->city
                    . ', ' . $info->getShippingAddress()->state
                    . ', ' . $info->getShippingAddress()->postal_code
                    . ', ' . $info->getShippingAddress()->country_code;
                $order->ORD_FUNDING = $result->payer->payment_method;
                $order->ORD_DISCOUNT = $paypal_details['discount'];
                $order->ORD_STATUS = $payment_info->state;
                $order->ORD_COMPLETE = ($payment_info->state!='pending')?Carbon::now():NULL;;
                $order->save();

                $orderi = new t_order_item();
                $orderi->ORD_ID = $order->ORD_ID;
                $orderi->PROD_ID = $paypal_details['prodID'];
                $orderi->PRODV_ID = ($paypal_details['prodvID'] != 0) ? $paypal_details['prodvID'] : null;
                $orderi->ORDI_QTY = $paypal_details['qty'];
                $orderi->ORDI_NOTE = $paypal_details['prod_note'];
                $orderi->PROD_NAME = $paypal_details['prodName'];
                $orderi->PROD_SKU = $paypal_details['sku'];
                $orderi->PROD_MY_PRICE = $paypal_details['price'];
                $orderi->PROD_DESC = $paypal_details['prodDesc'];
                $orderi->ORDI_SOLD_PRICE = $result->getTransactions()[0]->amount->total;
                $orderi->save();

                $invoice = new t_invoice();
                $invoice->INV_NO = $paypal_details['invoice'];
                $invoice->ORD_ID = $order->ORD_ID;
                $invoice->INV_STATUS = $payment_info->state;
                $invoice->INV_DETAILS = 'Thank you for purchasing on SympiesShop';
                $invoice->save();

                $payment_ = new t_payment();
                $payment_->INV_ID = $invoice->INV_ID;
                $payment_->PAY_RECIEVED_BY = 'SympiesShop';
                $payment_->PAY_AMOUNT_DUE = $result->getTransactions()[0]->amount->total;
                //compute
                $payment_->PAY_SUB_TOTAL =$paypal_details['subtotal'];
                $payment_->PAY_SALES_TAX =$paypal_details['salestax'];
                $payment_->PAY_DELIVERY_CHARGE =$paypal_details['delivery'];
                $payment_->PAY_CAPTURED_AT = ($payment_info->state!='pending')?Carbon::now():NULL;
                $payment_->save();

                $shipment = new t_shipment();
                $shipment->SHIP_TRACKING_NO = uniqid('SHIP-');
                $shipment->ORD_ID = $order->ORD_ID;
                $shipment->INV_ID = $invoice->INV_ID;
                $shipment->SHIP_STATUS = $payment_info->state;
                $shipment->SHIP_DESC = 'The item will delivered soon';
                $shipment->save();

                $shipment_ordi = new t_shipment_orderitem();
                $shipment_ordi->ORDI_ID = $orderi->ORDI_ID;
                $shipment_ordi->SHIP_ID = $shipment->SHIP_ID;
                $shipment_ordi->save();

                $inventory = new r_inventory_info();
                $inventory->ORDI_ID = $orderi->ORDI_ID;
                $inventory->PRODV_ID = ($paypal_details['prodvID'] != 0) ? $paypal_details['prodvID'] : null;
                $inventory->PROD_ID = $paypal_details['prodID'];
                $inventory->INV_QTY = $orderi->ORDI_QTY;
                $inventory->INV_TYPE = 'ORDER';
                $inventory->save();


                return view('pages.frontend-shop.checkout_complete', compact('trans','payment_info','paypal_details', 'info', 'Allprod', 'result', 'prodID', 'prodvID'));
            }
        }
        Session::put('payment_error', 'Payment failed');
        return Redirect::to('/');
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
            $order = new t_order();
            //$order->ORD_FROM_SYMPIES_ID = $sympiesCred['ID'];
            $order->ORD_ID = $ord_id;
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
            $orderi->save();

                // $invoice = new t_invoice();
                // $invoice->INV_NO = $invoice;
                // $invoice->ORD_ID = $order->ORD_ID;
                // $invoice->INV_DETAILS = 'Thank you for purchasing on SympiesShop';
                // $invoice->save();

            

            // $shipment = new t_shipment();
            // $shipment->SHIP_TRACKING_NO = uniqid('SHIP-');
            // $shipment->ORD_ID = $order->ORD_ID;
            // $shipment->INV_ID = $invoice->INV_ID;
            // $shipment->SHIP_STATUS = 'Pending';
            // $shipment->SHIP_DESC = 'The item will delivered soon';
            // $shipment->save();

            // $shipment_ordi = new t_shipment_orderitem();
            // $shipment_ordi->ORDI_ID = $orderi->ORDI_ID;
            // $shipment_ordi->SHIP_ID = $shipment->SHIP_ID;
            // $shipment_ordi->save();

            // $inventory = new r_inventory_info();
            // $inventory->ORDI_ID = $orderi->ORDI_ID;
            // $inventory->PRODV_ID = ($prodvID != 0) ? $prodvID : null;
            // $inventory->PROD_ID = $prodID;
            // $inventory->INV_QTY = $orderi->ORDI_QTY;
            // $inventory->INV_TYPE = 'ORDER';
            // $inventory->save();



            $Allprod = Sympies::filterAvailable(r_product_info::with('rAffiliateInfo', 'rProductType')
            ->where('PROD_IS_APPROVED', '1')
            ->where('PROD_DISPLAY_STATUS', 1)->get());
            $aff = r_affiliate_info::where('AFF_DISPLAY_STATUS',1)->get();
            $cat = r_product_type::with('rProductType')->where('PRODT_DISPLAY_STATUS',1)->get();

            return view('pages.frontend-shop.checkout',compact('Allprod','transcode','aff','cat','invoice','prodName','prodDesc','subtotal','prodImg'));

    }

    public  function refundTransaction(Request $request){

        $refund = new Refund();
    }
}
