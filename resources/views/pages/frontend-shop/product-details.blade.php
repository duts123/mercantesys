
@extends('layouts.frontend-main')

@section('title','Product Details')

@section('content')
    <!-- BEGIN #product -->
    <div id="product" class="section-container p-t-20">
        <!-- BEGIN container -->
        <div class="container">

        @foreach($getProd as $item)
            @php
                $total=$item->PROD_MY_PRICE;
            @endphp
            <!-- BEGIN product -->
            <div class="product">
                <!-- BEGIN product-detail -->
                <div class="product-detail">
                    <!-- BEGIN product-image -->
                    <div class="product-image">
                        <!-- BEGIN product-thumbnail -->
                        <div class="product-thumbnail">
                            <ul class="product-thumbnail-list">
                                <li class="active" data-toggle="tooltip" title="{{$item->PROD_NAME}}">
                                    <a href="#" data-click="show-main-image" data-url="{{($item->PROD_IMG==null||!file_exists($item->PROD_IMG))?asset('uPackage.png'):asset($item->PROD_IMG)}}">
                                        <img src="{{($item->PROD_IMG==null||!file_exists($item->PROD_IMG))?asset('uPackage.png'):asset($item->PROD_IMG)}}" alt="{{$item->PROD_NAME}}" />
                                    </a>
                                </li>
                                @foreach($getVar as $var)
                                    <li class="" data-toggle="tooltip" title="{{$var->PRODV_NAME}}">
                                        <a href="#" data-click="show-main-image" data-url="{{($var->PRODV_IMG==null||!file_exists($var->PRODV_IMG))?asset('uPackage.png'):asset($var->PRODV_IMG)}}">
                                            <img src="{{($var->PRODV_IMG==null||!file_exists($var->PRODV_IMG))?asset('uPackage.png'):asset($var->PRODV_IMG)}}" alt="{{$var->PRODV_NAME}}" alt="" />
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- END product-thumbnail -->
                        <!-- BEGIN product-main-image -->
                        <div class="product-main-image" data-id="main-image">
                            <img src="{{($item->PROD_IMG==null||!file_exists($item->PROD_IMG))?asset('uPackage.png'):asset($item->PROD_IMG)}}" alt="{{$item->PROD_NAME}}" alt="" />

                        </div>
                        <!-- END product-main-image -->
                    </div>
                    <!-- END product-image -->
                    <!-- BEGIN product-info -->
                    <div class="product-info"  >
                        <!-- BEGIN product-info-header -->
                        <div class="product-info-header">
                            <h1 class="product-title"><span class="label label-success">{{$discount = $item->PROD_DISCOUNT}}% OFF</span> {{$item->PROD_NAME}} </h1>
                            <ul class="product-category">

                                <li>
                                    <a href="#">
                                        {{ $cat->where('PRODT_ID',$item->PRODT_ID)->first()->rProductType->PRODT_TITLE ?? 'Not set'}}
                                    </a>
                                </li>
                                <li>/</li>
                                <li>
                                    <a href="#">
                                        {{ $cat->where('PRODT_ID',$item->PRODT_ID)->first()->PRODT_TITLE ?? 'Not set'}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- END product-info-header -->
                        <!-- BEGIN product-warranty -->
                        <div class="product-warranty">
                            <div class="pull-right">Availability: In stock</div>
                            <div><b>{{$item->rAffiliateInfo->AFF_NAME}}</b></div>
                        </div>
                        <!-- END product-warranty -->
                        <!-- BEGIN product-info-list -->
                        <span class="description">{{$item->PROD_DESC}}</span><br><br>
                        <ul class="product-info-list">

                            <li>
                                <i class="fa fa-circle"></i> {{$item->PROD_NAME }} - default
                            </li>
                            @foreach($getVar as $var)
                                <li>
                                    <i class="fa fa-circle"></i> {{$var->PRODV_NAME }} - {{Sympies::current_price(number_format((($discount)?$total-($total*($discount/100)):$total)+($var->PRODV_ADD_PRICE),2) ) }}
                                </li>
                            @endforeach
                        </ul>
                        <!-- END product-info-list -->
                        <!-- BEGIN product-social -->
                        <div class="product-social">
                            <ul>
                                <li><a href="javascript:;" class="facebook" data-toggle="tooltip" data-trigger="hover" data-title="Facebook" data-placement="top"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="javascript:;" class="twitter" data-toggle="tooltip" data-trigger="hover" data-title="Twitter" data-placement="top"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="javascript:;" class="google-plus" data-toggle="tooltip" data-trigger="hover" data-title="Google Plus" data-placement="top"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="javascript:;" class="whatsapp" data-toggle="tooltip" data-trigger="hover" data-title="Whatsapp" data-placement="top"><i class="fa fa-whatsapp"></i></a></li>
                                <li><a href="javascript:;" class="tumblr" data-toggle="tooltip" data-trigger="hover" data-title="Tumblr" data-placement="top"><i class="fa fa-tumblr"></i></a></li>
                            </ul>
                        </div>
                        <!-- END product-social -->
                        <!-- BEGIN product-purchase-container -->
                        <div class="product-purchase-container">

                            @if($item->DISCOUNT)
                                <div class="product-discount">
                                    <span class="discount">{{$item->DISCOUNT}}</span>
                                </div>
                            @endif
                            <div class="product-price">
                                <div class="price">{{$item->PRICE}}</div>
                            </div>
                            @if(Session::get('sympiesAccount'))
                                <a href="#buy"  id="buyProd" class="btn btn-success" data-toggle="modal" tooltip="tooltip" title= "Click to Buy"><i class="fa fa-credit-card-alt"></i> Buy</a>
                            @else
                                <a href="#login" data-toggle="modal"   class="btn btn-success"   tooltip="tooltip" title= "Please login to make transaction"><i class="fa fa-credit-card-alt"></i> Buy</a>
                            @endif

                            <center>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <!-- Container for PayPal Mark Checkout -->
                                    <div id="paypalCheckoutContainer"></div>
                                </div>
                            </div>
                            </center>
                        </div>
                        <!-- END product-purchase-container -->
                    </div>
                    <!-- END product-info -->
                </div>
                <!-- END product-detail -->
                <!-- BEGIN product-tab -->
                <div class="product-tab">
                    <!-- BEGIN #product-tab -->
                    <ul id="product-tab" class="nav nav-tabs">
                        <li class="active"><a href="#product-desc" data-toggle="tab">Product Description</a></li>
                    </ul>
                    <!-- END #product-tab -->
                    <!-- BEGIN #product-tab-content -->
                    <div id="product-tab-content" class="tab-content">
                        <!-- BEGIN #product-desc -->
                        <div class="tab-pane fade active in" id="product-desc">
                          @php echo $item->PROD_NOTE @endphp
                        </div>
                        <!-- END #product-desc -->

                    </div>
                    <!-- END #product-tab-content -->
                </div>
                <!-- END product-tab -->
            </div>
            <!-- END product -->

                <div class="modal modal-message fade" id="buy" >
                    <div class="modal-dialog" >
                        <div class="modal-content">
                            <!-- method="post" action="{{url('/checkout/execute')}}"  -->
                            <div class="modal-body" style="width: 90%;">
                                <form id="prodOrderNow"  method="post" action="{{route('addOrders')}}" _target="blank">
                                    {{csrf_field()}}
                                    <input id="prodID" name="prodID" value="{{$item->PROD_ID}}" style="display: none;">
                                    <input id="prodvID" name="prodvID" value="0" style="display: none;">
                                    <input id="prodIMG" name="prodIMG" value="{{($item->PROD_IMG==null||!file_exists($item->PROD_IMG))?asset('uPackage.png'):asset($item->PROD_IMG)}}" alt="{{$item->PROD_NAME}}" style="display: none;">
                                    <input type="text" name="product_id" value="{{$item->PROD_ID}}">
                                   <!-- BEGIN checkout-header -->
                                    <div class="checkout-header">
                                        <!-- BEGIN row -->
                                        <div class="row">
                                            <div class="col-md-12 text-white" style="padding-bottom: 20px;">
                                                <strong>You are about to checkout this item.</strong>
                                                <p>Please indicate how many items you want to checkout.</p>
                                            </div>
                                        </div>
                                        <!-- END row -->
                                    </div>
                                    <!-- END checkout-header -->
                                    <!-- BEGIN checkout-body -->
                                    <div class="checkout-body">
                                        <div class="table-responsive">
                                            <table class="table table-cart">
                                                <thead>
                                                <tr>
                                                    <th>Product Name</th>
                                                    <th class="text-center">Price</th>
                                                    <th class="text-center">Quantity</th>
                                                    <th class="text-center" width="10%">Total</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td class="cart-product">
                                                        <div class="product-img">
                                                            <img id="varimage" src="{{($item->PROD_IMG==null||!file_exists($item->PROD_IMG))?asset('uPackage.png'):asset($item->PROD_IMG)}}" alt="{{$item->PROD_NAME}}" alt="" />
                                                        </div>
                                                        <div class="product-info" >
                                                            <div class="title">
                                                                @if(count($getVar))
                                                                    <select class="form-control" id="prodVars" name="prodVars" style="width: 100%;" required>
                                                                        <option img="{{$item->PROD_IMG}}" price="{{(($discount)?$total-($total*($discount/100)):$total)}}" prodid="{{$item->PROD_ID}}" prodvar="0" selected>{{$item->PROD_NAME}}</option>
                                                                        @foreach($getVar as $var)
                                                                            <option img="{{$var->PRODV_IMG}}" price="{{(($discount)?$total-($total*($discount/100)):$total)+($var->PRODV_ADD_PRICE) }}" prodid="{{$item->PROD_ID}}"  prodvar="{{$var->PRODV_ID}}">{{$var->PRODV_NAME}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                @else
                                                                    {{$item->PROD_NAME}}
                                                                @endif
                                                            </div>
                                                            <div class="desc">{{$item->PROD_DESC}}</div>
                                                            <br>
                                                            <div class="desc">
                                                                <label data-toggle="tooltip" title="to help the seller to customize product">Item Note: </label>
                                                                <textarea data-toggle="tooltip" title="to help the seller to customize product" class="form-control" name="prodnote" style="resize: vertical;width: 100%;height: 78px;margin-top: 0px;margin-bottom: 0px;" placeholder="Buyer note to seller" ></textarea>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td id = cart-price class="cart-price text-center" val="{{(($discount)?$total-($total*($discount/100)):$total)}}">{{$item->PRICE}}</td>
                                                    <td class="cart-qty text-center">
                                                        <div class="cart-qty-input">
                                                            <a id=change href="#" class="qty-control left disabled" data-click="decrease-qty" data-target="#qty"><i class="fa fa-minus"></i></a>
                                                            <input  type="text" name="qty" value="1" min=1 class="form-control cart-qty " id="qty" />
                                                            <a id=change href="#" class="qty-control right disabled" data-click="increase-qty" data-target="#qty"><i class="fa fa-plus"></i></a>
                                                        </div>
                                                        <div class="qty-desc">1 to max order</div>
                                                    </td>
                                                    <td id=cart-total class="cart-total text-center" >
                                                        {{$item->PRICE}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="cart-summary" colspan="4">
                                                        <div style="float: left; width: 50%">
                                                            <div class="panel-body panel-form">
                                                                <form class="form-horizontal form-bordered">
                                                                    {{--<div class="form-group row">
                                                                        <label class="col-md-4 col-form-label">Send Gift to:</label>
                                                                        <div class="col-md-8">
                                                                            <select class="form-control" id="recSympies" name="recSympies" style="width: 100%;" required >
                                                                                <option value="0" disabled selected>Please Select Sympies User</option>
                                                                                @foreach($sympiesUser as $item)
                                                                                    <option value="{{$item->rac_accountid}}">{{$item->rac_username}}</option>
                                                                                    Send Gift to @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>--}}
                                                                    <br>
                                                                    <div class="form-group row">
                                                                        <label class="col-md-4 col-form-label">Receiver's Email</label>
                                                                        <div class="col-md-8">
                                                                            <div class="row row-space-10">

                                                                                <input type="email" class="form-control" name="to_email" value="" placeholder="jonhdoe@gmail.com" required />
                                                                            </div>
                                                                           
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                    <div class="form-group row">
                                                                        <label class="col-md-4 col-form-label">Receiver's Contact No.</label>
                                                                        <div class="col-md-8">
                                                                            <div class="row row-space-10">

                                                                                <input type="text" class="form-control" name="to_contact" value="" placeholder="09478001577" required/>
                                                                            </div>
                                                                        </div>
                                                                    </div><br>
                                                                    <div class="form-group row">
                                                                        <label class="col-md-12 col-form-label">Receiver's Address</label>
                                                                        <div class="col-md-8 col-lg-2">
                                                                            <div class="row row-space-10">

                                                                                <input type="text" class="form-control" name="houseno" value="" placeholder="House#" required/>
                                                                            </div>
                                                                        </div>
                                                                        <div class=" col-lg-4">
                                                                            <div class="row row-space-10">

                                                                                <input type="text" class="form-control" name="street" value="" placeholder="Street" required/>
                                                                            </div>
                                                                        </div>
                                                                        <div class=" col-lg-4">
                                                                            <div class="row row-space-10">

                                                                                <input type="text" class="form-control" name="barangay" value="" placeholder="Barangay" required/>
                                                                            </div>
                                                                        </div>
                                                                        <div class=" col-lg-4" style="margin-top: -34px; margin-left: 473px">
                                                                            <div class="row row-space-10">

                                                                                <input type="text" class="form-control" name="city" value="" placeholder="City" required/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="summary-container">
                                                            <div class="summary-row text-black">
                                                                <div class="field">Sub-total</div>
                                                                <input name="subtotal" value="" style="display: none"><div class="value" id="sub-total"> {{$item->PRICE}}</div>
                                                            </div>
                                                            <br>
                                                            <div class="summary-row text-black">
                                                                <div class="field">Tax Rate</div>
                                                                @php
                                                                    $val = Sympies::active_currency()->rTaxTableProfile->TAXP_RATE;
                                                                    $tax = (Sympies::active_currency()->rTaxTableProfile->TAXP_TYPE==0)?$val.' %':Sympies::active_currency()->CURR_SYMBOL.' '.$val;
                                                                @endphp
                                                                <div class="value"> {{$tax}}</div>
                                                            </div>
                                                            <div class="summary-row text-black">
                                                                <div class="field">Sales Tax</div>
                                                                @php
                                                                
                                                                    $val = Sympies::active_currency()->rTaxTableProfile->TAXP_RATE;
                                                                    $taxPercent = (Sympies::active_currency()->rTaxTableProfile->TAXP_TYPE==0)?$val:0;
                                                                    $taxFixed = (Sympies::active_currency()->rTaxTableProfile->TAXP_TYPE==1)?$val:0;
                                                                    $taxSale = number_format(($taxPercent)?($item->PROD_MY_PRICE*($taxPercent/100)):$taxFixed,2);
                                                                @endphp
                                                                <input name="saletax" value="{{$taxSale}}" style="display: none"><div id=sale-tax class="value"> {{Sympies::active_currency()->CURR_SYMBOL.' '.$taxSale}}</div>
                                                            </div>
                                                            <div class="summary-row text-black">
                                                                <div class="field">Delivery Charge</div>
                                                                <div class="value"> {{Sympies::current_price(number_format(Sympies::active()->SET_DEL_CHARGE,2))}}</div>
                                                            </div>
                                                            <div class="summary-row total">
                                                                <div class="field">Grand Total</div>
                                                                <div class="value" id="total-cart">{{$item->PRICE}}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- END checkout-body -->
                                    <div class="checkout-footer">
                                        <!-- PayPal Logo -->
                                        <table border="0" cellpadding="10" cellspacing="0" align="left">
                                        <tr>
                                        <td align="center"></td>
                                        </tr>
                                        <tr>
                                        <td align="center">
                                        
                                        </td>
                                        </tr>
                                        </table>
                                        <!-- PayPal Logo -->
                                        <a href="javascript:;" data-dismiss="modal"   title=""  class="btn btn-danger btn-lg p-l-30 p-r-30 m-l-10">Check Another</a>
                                        <input type="submit" title="Pay using paypal"  class="btn btn-inverse btn-lg p-l-30 p-r-30 m-l-10" value="Checkout">
                                    </div>
                                    <!-- END checkout-body -->
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- BEGIN similar-product -->
            <h4 class="m-b-15 m-t-30">You Might Also Like</h4>
            <div class="row row-space-10">

            @foreach($randProd->take(6) as $item)
                <!-- BEGIN col-2 -->
                    <div class="col-md-2 col-sm-4">
                        <!-- BEGIN item -->
                        <div class="item item-thumbnail">
                            <a href="{{url('product/details/'.$item->PROD_ID)}}" class="item-image">
                                <img src="{{($item->PROD_IMG==null||!file_exists($item->PROD_IMG))?asset('uPackage.png'):asset($item->PROD_IMG)}}" alt="" />
                                @php $discount=$item->PROD_DISCOUNT @endphp
                                @if($discount!=0)<div class='discount' >{{$discount}}% OFF</div>@endif
                            </a>
                            <div class="item-info">
                                <h4 class="item-title">
                                    <a href="{{url('product/details/'.$item->PROD_ID)}}">{{$item->PROD_NAME}}<br />
                                        <span style="color:gray">{{$item->rAffiliateInfo->AFF_NAME}}</span>
                                    </a>
                                </h4>
                                <p class="item-desc" title="{{$item->PROD_DESC}}">{{$item->PROD_DESC}}</p>

                                <div class="item-price">
                                    {{$item->PRICE}}
                                </div>
                                <div class="item-discount-price">
                                    {{$item->DISCOUNT}}
                                </div>
                            </div>
                        </div>
                        <!-- END item -->
                    </div>
                    <!-- END col-2 -->
                @endforeach

            </div>
            <!-- END similar-product -->
        </div>
        <!-- END container -->
    </div>
    <!-- END #product -->

@endsection
@section('extrajs')
    <script>

        var $currency = '{{Sympies::active_currency()->CURR_SYMBOL}}'+' ';
        var $percent = parseInt('{{(Sympies::active_currency()->rTaxTableProfile->TAXP_TYPE==0)?Sympies::active_currency()->rTaxTableProfile->TAXP_RATE:0}}');
        var $fixed =parseInt('{{(Sympies::active_currency()->rTaxTableProfile->TAXP_TYPE==1)?Sympies::active_currency()->rTaxTableProfile->TAXP_RATE:0}}');
        var $delivery = parseInt('{{Sympies::active()->SET_DEL_CHARGE}}');


        $('select').select2({ dropdownParent: $('#prodOrderNow')});

        updateCart();

        $('select[id=prodVars]').on('change',function(){

            $('td[id=cart-price]').attr('val',$(this).children('option:selected').attr('price'));
            $('td[id=cart-price]').text($currency+moneyFormat(parseFloat($(this).children('option:selected').attr('price')).toFixed(2)));
            $('img[id=varimage]').attr('src','{{url('/')}}/'+$(this).children('option:selected').attr('img'));
            $('input[id=qty]').trigger('keyup');

            $('input[id=prodIMG]').val('{{url('/')}}/'+$(this).children('option:selected').attr('img'));
            $('input[id=prodID]').val($(this).children('option:selected').attr('prodid'));
            $('input[id=prodvID]').val($(this).children('option:selected').attr('prodvar'));

        });

        $('input[id=qty]').on('keyup',function(){
            updateCart();
        });
        $('a[id=change]').on('click',function(){

            updateCart();
        });

        function updateCart(){
                setTimeout(function() {
                    $qty = $('input[id=qty]').val();
                $total = $('td[id=cart-price]').attr('val') * $qty;
                if(!$percent) {
                    $computed = $total + $delivery + $fixed;
                    $sale_tax = $fixed;
                }
                else {
                    $computed = $total + ($total * ($percent / 100)) + $delivery;
                    $sale_tax = ($total * ($percent / 100));
                }

                $('td[id=cart-total]').text($currency+moneyFormat($total.toFixed(2)));
                $('div[id=total-cart]').text($currency+moneyFormat($computed.toFixed(2)));
                $('div[id=sub-total]').text($currency+moneyFormat($total.toFixed(2)));
                $('div[id=sale-tax]').text($currency+moneyFormat($sale_tax.toFixed(2)));


                $('input[name=subtotal]').val($total.toFixed(2));
                $('input[name=saletax]').val($sale_tax.toFixed(2));

            }, 100);
        }
    </script>
@endsection

