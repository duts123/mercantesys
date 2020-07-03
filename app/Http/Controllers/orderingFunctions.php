<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\t_order_item;
use App\t_order;
use App\t_invoice;
use App\t_payment;
use App\t_shipment_orderitem;
use App\t_shipment;


class orderingFunctions extends Controller
{
    //


    function makeOrder(Request $request)
    {
        $t_order = new r_order();
        $t_order_item = new t_order_item();
        $t_invoice = new t_invoice();
        $t_payment = new t_payment();
        $t_shipment_orderitem = new t_shipment_orderitem();
        $t_shipment = new t_shipment();     
    }
}
