    @extends('layouts.main')

    @section('title','Invoice')

@section('content')

<!-- begin breadcrumb -->
			<ol class="breadcrumb hidden-print pull-right">
				<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
				<li class="breadcrumb-item active">Invoice</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header hidden-print">{{$invoice->INV_NO}} </h1>
			<!-- end page-header -->

			<!-- begin invoice -->
            <div class="invoice-company text-inverse f-w-600" style="padding: 10px;background: white;">
                                <span class="pull-right hidden-print">
                                <a href="javascript:;" onclick="prints()" class="btn btn-sm btn-white m-b-10 p-l-5"><i class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print</a>
                                </span>
                Sympies (Affiliate Name)
            </div>
                <br>
			<div class="invoice">
                <!-- begin invoice-header -->
                <div class="invoice-header">
                    <div class="invoice-from">
                        <small>from</small>
                        <address class="m-t-5 m-b-5">
                            <strong class="text-inverse">{{ $order->ORD_FROM_NAME }}</strong><br />
                            Email: {{$order->ORD_FROM_EMAIL}} <br />
                            Phone: {{$order->ORD_FROM_CONTACT}}<br />
                        </address>
                    </div>
                    <div class="invoice-to">
                        <small>to</small>
                        <address class="m-t-5 m-b-5">
                            <strong class="text-inverse">{{ $order->ORD_TO_NAME }}</strong><br />
                            {{ $order->ORD_TO_ADDRESS }}<br />
                            Email: {{$order->ORD_TO_EMAIL}} <br />
                            Phone: {{$order->ORD_TO_CONTACT}}<br />
                        </address>
                    </div>
                    <div class="invoice-date">
                        <small>Invoice / {{(new DateTime($invoice->created_at))->format('F') }} period</small>
                        <div class="date text-inverse m-t-5">{{(new DateTime($invoice->created_at))->format('F d, Y') }}</div>
                        <div class="invoice-detail">
                            {{$invoice->INV_NO}}<br />
                            {{$invoice->INV_DETAILS}}<br />
                        </div>
                    </div>
                </div>
                <!-- end invoice-header -->
                <!-- begin invoice-content -->
                <div class="invoice-content">
                	<!-- begin table-responsive -->
                    <div class="table-responsive">
                        <table class="table table-invoice">
                            <thead>
                                <tr>
                                    <th>ITEM DESCRIPTION</th>
                                    <th class="text-center" width="10%">Price</th>
                                    <th class="text-center" width="10%">Discount</th>
                                    <th class="text-center" width="10%">Quantity</th>
                                    <th class="text-right" width="20%">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($order_items as $oi)

                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <center>
                                                        <a href="{{(!file_exists('uploads/'.$oi->PROD_SKU.'.jpg'))?asset('uPackage.png'):asset('uploads/'.$oi->PROD_SKU.'.jpg')}}" data-lightbox="gallery-group-1">
                                                            <img style="width: 50%;height: 100%;" src="{{(!file_exists('uploads/'.$oi->PROD_SKU.'.jpg'))?asset('uPackage.png'):asset('uploads/'.$oi->PROD_SKU.'.jpg')}}">
                                                        </a>
                                                    </center>
                                                    <br>
                                                </div>
                                                <div class="col-md-8">
                                                   <span class="text-inverse"> {{$oi->PROD_NAME}} </span><br />
                                                   <small>{{$oi->PROD_DESC}}</small>
                                                </div>
                                            </div>

                                        </td>
                                        <td class="text-center">{{Sympies::current_price(number_format($oi->PROD_MY_PRICE,2))}}</td>

                                        <td class="text-center">{{((!$oi->PROD_DISCOUNT)?'0':$oi->PROD_DISCOUNT).'%' }}</td>
                                        <td class="text-center">{{$oi->ORDI_QTY}}</td>
                                        <td class="text-right">{{Sympies::current_price(number_format($oi->PROD_MY_PRICE *$oi->ORDI_QTY,2))}}</td>
                                    </tr>

                              @endforeach
                            </tbody>
                        </table>
                    </div>
                	<!-- end table-responsive -->
                	<!-- begin invoice-price -->

                    <div class="invoice-price">
                        <div class="invoice-price-left">
                            <div class="invoice-price-row">
                                <div class="sub-price">
                                    <small>SUBTOTAL</small>
                                    <span class="text-inverse">{{Sympies::current_price(number_format($oi->PROD_MY_PRICE *$oi->ORDI_QTY,2))}}</span>

                                </div>
                                <div class="sub-price">
                                    <i class="fa fa-plus text-muted"></i>
                                </div>
                                {{--
                                <div class="sub-price">
                                    <small>SALES TAX</small>
                                    <span class="text-inverse">{{Sympies::current_price(number_format($payment->PAY_SALES_TAX,2))}}</span>
                                </div>
                                <div class="sub-price">
                                    <i class="fa fa-plus text-muted"></i>
                                </div>
                                <div class="sub-price">
                                    <small>DELIVERY CHARGE</small>
                                    <span class="text-inverse">{{Sympies::current_price(number_format($payment->PAY_DELIVERY_CHARGE,2)) }}</span>
                                </div>
                                --}}
                            </div>
                        </div>
                        <div class="invoice-price-right">
                            {{--<small>TOTAL</small> <span class="f-w-600">{{Sympies::current_price(number_format($payment->PAY_AMOUNT_DUE,2)) }}</span>--}}
                             <small>TOTAL</small> <span class="f-w-600">{{Sympies::current_price(number_format($oi->PROD_MY_PRICE *$oi->ORDI_QTY,2))}}</span>
                        </div>
                    </div>
                	<!-- end invoice-price -->
                </div>
                <!-- end invoice-content -->
                <!-- begin invoice-note -->
                <div class="invoice-note">
                    * Make all cheques payable to [Your Company Name]<br />
                    * Payment is due within 30 days<br />
                    * If you have any questions concerning this invoice, contact  [Name, Phone Number, Email]
                </div>
                <!-- end invoice-note -->
                <!-- begin invoice-footer -->
                <div class="invoice-footer">
                    <p class="text-center m-b-5 f-w-600">
                        THANK YOU FOR YOUR BUSINESS
                    </p>
                    <p class="text-center">
                        <span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i>sympies.net</span>
                        <span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i> kuyaruegivemenumb</span>
                        <span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i> admin@sympies.net</span>
                    </p>
                </div>
                <!-- end invoice-footer -->
            </div>
			<!-- end invoice -->
		</div>
		<!-- end #content -->

        
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->

@endsection

@section('extrajs')

    <script>

        function prints(){
            $('body > :not(.invoice)').hide();
            $('.invoice').appendTo('body');
            window.print();
            location.reload();
        }



    </script>
@endsection
