
@extends('layouts.frontend-main')

@section('title','Checkout Complete')

@section('content')


    <div class="section-container" id="checkout-cart">
        <!-- BEGIN container -->
        <div class="container">
            <!-- BEGIN checkout -->
            <div class="checkout">
                <form >
                    <!-- BEGIN checkout-header -->
                    <div class="checkout-header">
                        <!-- BEGIN row -->
                        <div class="row">
                            <div class="col-md-12 text-white" style="padding-bottom: 20px;">
                                <strong>Thank you! </strong>
                                <p>Your Payment has been successfully processed with the following details.</p>
                            </div>
                        </div>
                        <!-- END row -->
                    </div>
                    <!-- END checkout-header -->
                    <!-- BEGIN checkout-body -->
                    <div class="checkout-body">
                        <!-- BEGIN checkout-message -->
                        <div class="checkout-message">

                            <div class="table-responsive2">
                                <table class="table table-payment-summary">
                                    <tbody>
                                    <tr>
                                        <td class="field">Transaction Status</td>
                                        <td class="value">Pending</td>
                                    </tr>
                                    <tr>
                                        <td class="field">Reference No.</td>
                                        <td class="value">{{$order_details['transcode']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="field">Invoice No.</td>
                                        <td class="value"><a href="{{asset('')}}invoice/details/{{$order_details['ord_id']}}" target="_blank">{{$order_details['invoice']}}</a></td>
                                    </tr>
                                    {{--<tr>
                                        <td class="field">Transaction Code</td>
                                        <td class="value">{{$payment_info->id}}</td>
                                    </tr>--}}
                                    <tr>
                                        <td class="field">Transaction Date and Time</td>
                                        <td class="value">{{\Carbon\Carbon::now()->format('D M d, Y | h:i A')}}</td>
                                    </tr>
                                    <tr>
                                        <td class="field">Orders</td>
                                        <td class="value product-summary">
                                            <div class="product-summary-img">
                                                <img src="{{asset($order_details['prodImg'])}}" alt="" />
                                            </div>
                                            <div class="product-summary-info">
                                                <div class="title">{{$order_details['prodName']}}</div>
                                                <div class="desc">{{$order_details['prodDesc']}}</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Payment Amount ({{Sympies::active_currency()->CURR_ACR}})</td>
                                        <td class="value">{{$order_details['subtotal']}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p class="text-muted text-center m-b-0">Should you require any assistance, you can get in touch with Support Team at (123) 456-7890</p>
                        </div>
                        <!-- END checkout-message -->
                    </div>
                    <!-- END checkout-body -->
                    <!-- BEGIN checkout-footer -->
                    </form>
                    <div class="checkout-footer text-center">
                        <a href="{{asset('')}}invoice/details/{{$order_details['ord_id']}}" class="btn btn-white btn-lg p-l-30 p-r-30 m-l-10">Manage Orders</a>
                    </div>
                    <!-- END checkout-footer -->
                
            </div>
            <!-- END checkout -->
        </div>
        <!-- END container -->
    </div>
    <!-- END #checkout-cart -->

@endsection

@section('extrajs')
    <script>

    </script>
@endsection
