@php
    $account = \Session::get('sympiesAccount');

@endphp
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Mercante | @yield('title')</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="{{asset('assets/plugins/bootstrap3/css/bootstrap.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/animate/animate.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/css/e-commerce/style.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/css/e-commerce/style-responsive.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/css/e-commerce/theme/default.css')}}" id="theme" rel="stylesheet" />
    <link href="{{asset('assets/plugins/jquery-smart-wizard/src/css/smart_wizard.css')}}" rel="stylesheet" />

    <link href="{{asset('assets/plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/parsley/src/parsley.css')}}" rel="stylesheet" />

	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{asset('assets/plugins/pace/pace.min.js')}}"></script>
	<!-- ================== END BASE JS ================== -->
    <style>
        /* width */
        ::-webkit-scrollbar {
            width: 5px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px white;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #00acac;
            border-radius: 5px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #00acac;
        }
    </style>
</head>

<body>
    <!-- BEGIN #page-container -->
    <div id="page-container" class="fade">
        <!-- BEGIN #top-nav -->
        <div id="top-nav" class="top-nav" style="background-color: #f26439;">
            <!-- BEGIN container -->
            <div class="container">
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        
                        <li><a href="#">Customer Care</a></li>
                        <li><a href="#">Order Tracker</a></li>
                    </ul>
                    
                </div>
            </div>
            <!-- END container -->
        </div>
        <!-- END #top-nav -->

        <!-- BEGIN #header -->
        <div id="header" class="header">
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN header-container -->
                <div class="header-container">
                    <!-- BEGIN navbar-header -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="header-logo">
                            <a href="{{url('/')}}">
                                <span style="color: #f26439;">Mercan</span>te'
                                <small>e-commerce, 360° of Kindness</small>
                            </a>
                        </div>
                    </div>
                    <!-- END navbar-header -->
                    <!-- BEGIN header-nav -->
                    <div class="header-nav">
                        <div class=" collapse navbar-collapse" id="navbar-collapse">
                            <ul class="nav">
                                <li class="{{Request::is('/')?'active':''}}"><a href="{{url('/')}}">Home</a></li>
                                @if(Session::get('sympiesAccount'))
                                    <li class="{{Request::is('/summary-orders')?'active':''}}" ><a href="{{url('/summary-orders')}}">Manage Orders</a></li>
                                @endif
                                <li class="dropdown dropdown-hover">
                                    <a href="#" data-toggle="dropdown">
                                        <i class="fa fa-search search-btn"></i>
                                        <span class="arrow top"></span>
                                    </a>
                                    <div class="dropdown-menu p-15">
                                        <form action="{{url('/search')}}" method="GET" name="search_form">
                                            <div class="input-group">
                                                <input required name='search' type="text" placeholder="Search" class="form-control bg-silver-lighter" />
                                                <span class="input-group-btn">
                                                    <button class="btn btn-inverse" type="submit"><i class="fa fa-search"></i></button>
                                                </span>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- END header-nav -->
                    <!-- BEGIN header-nav -->
                    <div class="header-nav">
                        <ul class="nav pull-right">
                            <!-- <li class="dropdown dropdown-hover">
                                <a href="#" class="header-cart" data-toggle="dropdown">
                                    <i class="fa fa-shopping-bag"></i>
                                    <span class="total">2</span>
                                    <span class="arrow top"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-cart p-0">
                                    <div class="cart-header">
                                        <h4 class="cart-title">Shopping Bag (1) </h4>
                                    </div>
                                    <div class="cart-body">
                                        <ul class="cart-item">
                                            <li>
                                                <div class="cart-item-image"><img src="../assets/img/product/product-ipad.jpg" alt="" /></div>
                                                <div class="cart-item-info">
                                                    <h4>iPad Pro Wi-Fi 128GB - Silver</h4>
                                                    <p class="price">$699.00</p>
                                                </div>
                                                <div class="cart-item-close">
                                                    <a href="#" data-toggle="tooltip" data-title="Remove">&times;</a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="cart-item-image"><img src="../assets/img/product/product-imac.jpg" alt="" /></div>
                                                <div class="cart-item-info">
                                                    <h4>21.5-inch iMac</h4>
                                                    <p class="price">$1299.00</p>
                                                </div>
                                                <div class="cart-item-close">
                                                    <a href="#" data-toggle="tooltip" data-title="Remove">&times;</a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="cart-item-image"><img src="../assets/img/product/product-iphone.png" alt="" /></div>
                                                <div class="cart-item-info">
                                                    <h4>iPhone 6s 16GB - Silver</h4>
                                                    <p class="price">$649.00</p>
                                                </div>
                                                <div class="cart-item-close">
                                                    <a href="#" data-toggle="tooltip" data-title="Remove">&times;</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="cart-footer">
                                        <div class="row row-space-10">
                                            <div class="col-xs-6">
                                                <a href="checkout_cart.html" class="btn btn-default btn-block">View Cart</a>
                                            </div>
                                            <div class="col-xs-6">
                                                <a href="checkout_cart.html" class="btn btn-inverse btn-block">Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li> -->
                            <li>
                                <a href="{{(!is_null($account))?'javascript:;':'#login'}}" data-toggle="modal" >
                                    <img src="{{asset('assets/img/user/user-12.jpg')}}" class="user-img" alt="" />
                                    <span class="hidden-md hidden-sm hidden-xs">
                                      {{(!is_null($account))?$account['NAME']:'Not Logged In'}}
                                    </span>
                                </a>
                            </li>
                            @if(is_null($account))
                            <li>
                                <a href="#register" data-toggle="modal" >
                                    <span class="hidden-md hidden-sm hidden-xs">
                                     Create Account
                                    </span>
                                </a>
                            </li>
                            @endif
                            @if(!is_null($account))
                                <li class="divider"></li>
                                <li>
                                    <a href="{{url("/logoutSympiesAccount/".$account['ID'])}}"  >
                                        <span class="hidden-md hidden-sm hidden-xs">Logout
                                    </span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <!-- END header-nav -->
                </div>
                <!-- END header-container -->
            </div>
            <!-- END container -->
        </div>
        <!-- END #header -->
        
        @yield('content')

        <!-- BEGIN #footer -->
        <div id="footer" class="footer">
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN row -->
                <div class="row">
                    <!-- BEGIN col-3 -->
                    <div class="col-md-3">
                        <h4 class="footer-header">ABOUT US</h4>
                        <p>  </p>
                    </div>
                    <!-- END col-3 -->
                    <!-- BEGIN col-3 -->
                    <div class="col-md-3">
                        <h4 class="footer-header">RELATED LINKS</h4>
                        <ul class="fa-ul">
                            <li><i class="fa fa-li fa-angle-right"></i> <a href="#">Shopping Help</a></li>
                            <li><i class="fa fa-li fa-angle-right"></i> <a href="#">Terms of Use</a></li>
                            <li><i class="fa fa-li fa-angle-right"></i> <a href="#">Contact Us</a></li>
                            <li><i class="fa fa-li fa-angle-right"></i> <a href="#">Careers</a></li>
                            <li><i class="fa fa-li fa-angle-right"></i> <a href="#">Payment Method</a></li>
                            <li><i class="fa fa-li fa-angle-right"></i> <a href="#">Sales & Refund</a></li>
                            <li><i class="fa fa-li fa-angle-right"></i> <a href="{{url('/login')}}" target="_blank">Affiliate</a></li>
                            <li><i class="fa fa-li fa-angle-right"></i> <a href="#">Privacy & Policy</a></li>
                        </ul>
                    </div>
                    <!-- END col-3 -->
                    <!-- BEGIN col-3 -->
                    <div class="col-md-3">
                        <h4 class="footer-header">LATEST PRODUCT</h4>
                        <ul class="list-unstyled list-product">
                            @foreach($Allprod->sortby('created_at')->take(3) as $item)
                            <li>
                                <div class="image" style="overflow:hidden">
                                    <img src="{{($item->PROD_IMG==null||!file_exists($item->PROD_IMG))?asset('uPackage.png'):asset($item->PROD_IMG)}}" alt="" />
                                </div>
                                <div class="info">
                                    <h4 class="info-title">{{$item->PROD_NAME}}</h4>
                                    <div class="price">
                                       {{$item->PRICE}}
                                        </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- END col-3 -->
                    <!-- BEGIN col-3 -->
                    <div class="col-md-3">
                        <h4 class="footer-header">OUR CONTACT</h4>
                        <address>
                            <strong>Mercante, Inc.</strong><br />
                            Address<br /><br />
                            <abbr title="Phone">Phone:</abbr> (123) 456-7890<br />
                            <abbr title="Fax">Fax:</abbr> (123) 456-7891<br />
                            <abbr title="Email">Email:</abbr> <a href="mailto:sales@myshop.com">sales@myshop.com</a><br />
                            <abbr title="Skype">Skype:</abbr> <a href="skype:myshop">myshop</a>
                        </address>
                    </div>
                    <!-- END col-3 -->
                </div>
                <!-- END row -->
            </div>
            <!-- END container -->
        </div>
        <!-- END #footer -->

        <!-- BEGIN #footer-copyright -->
        <div id="footer-copyright" class="footer-copyright">
            <!-- BEGIN container -->
            <div class="container">
                <div class="payment-method">
                    <img src="{{asset('assets/img/payment/payment-method.png')}}" alt="" />
                </div>
                <div class="copyright">
                    Copyright &copy; {{date('Y')}} Mercante . All rights reserved.
                </div>
            </div>
            <!-- END container -->
        </div>
        <!-- END #footer-copyright -->
    </div>
    <!-- END #page-container -->

    <!-- #modal-dialog -->
    <div class="modal fade" id="login">
        <div class="modal-dialog" style="width:500px;">
            <div class="modal-content">
                <div class="modal-header" style="background: #ffffff;">
                    <h4 class="modal-title">Welcome! Please Login to continue</h4>
                </div>
                <div class="modal-body">

                    <div class="row" style="padding: 20px;">

                        <div class="col-md-12">
                            <div class="alert alert-danger " id="danger" style="display: none;">
                                Invalid Credentials
                            </div>
                            <div class="alert alert-success " id="success" style="display: none;">
                                Loading ...
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Username</label>
                            <input class="form-control" id="username" name=username type="text" placeholder="Username" required>
                        </div>
                        <br>
                        <div class="col-md-12" style="padding-top: 20px;">
                            <label>Password</label>
                            <input class="form-control" id="password" type="password" name=password placeholder="Password" required>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">  Cancel</a>
                    <a href="javascript:;" type="submit" id="loginbtn" class="btn btn-info">Login</a>
                </div>
            </div>
        </div>
    </div>

        <div class="modal fade" id="register">
        <div class="modal-dialog" style="width:600px;">
            <div class="modal-content">
                <div class="modal-header" style="background: #ffffff;">
                    <h4 class="modal-title">Welcome! Create Account</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('createUser') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            {{--@if (session('success'))
                                <div class="alert alert-success">
                                    You've Successfully Created Your Account ...
                                </div>
                            @endif--}}
                        </div>
                        
                        <div class="col-lg-12 col-md-6" style="padding-top: 15px;">
                            <div class="stats-content">
                                <label for="bfirstname">Full Name<span class="text-danger">*</span></label> 
                                <input class="form-control" id="fullname" name="fullname" placeholder="Full Name" style="text-transform: capitalize;"  />
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6" style="padding-top: 18px;">
                            <div class="stats-content">
                                <label for="bfirstname">Email<span class="text-danger">*</span></label> 
                                <input class="form-control" id="email" name="email" placeholder="mercante@gmail.com"  />

                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6" style="padding-top: 18px;">
                            <div class="stats-content">
                                <label for="bfirstname">Contact Number<span class="text-danger">*</span></label> 
                                <input class="form-control" id="contact" name="contact" placeholder="09223441729"  />

                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6" style="padding-top: 18px;">
                            <div class="stats-content">
                                <label for="bfirstname">Password<span class="text-danger">*</span></label> 
                                <input class="form-control" type="password" id="password" name="password" />

                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6" style="padding-top: 18px;">
                            <div class="stats-content">
                                <label for="bfirstname">House No#<span class="text-danger">*</span></label> 
                                <input class="form-control" id="houseno" name="houseno" placeholder="146"  />

                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6" style="padding-top: 18px;">
                            <div class="stats-content">
                                <label for="middlename">Street<span class="text-danger">*</span></label>
                                <input class="form-control" id="street" name="street" placeholder="Street" style="text-transform: capitalize;"/>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6" style="padding-top: 18px;">
                            <div class="stats-content">
                                <label for="lastname">Brgy<span class="text-danger">*</span></label>
                                <input class="form-control" id=brgy name="brgy" placeholder="Silangan" style="text-transform: capitalize;"/>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6" style="padding-top: 18px;">
                            <div class="stats-content">
                                <label for="lastname">City<span class="text-danger">*</span></label>
                                <input class="form-control" id=city name=city placeholder="Quezon City" style="text-transform: capitalize;"/>
                            </div>
                        </div>
                        
                    </div> <br>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">  Cancel</a>
                    <button  type="submit" class="btn btn-info btn-submit">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- #modal-without-animation -->



	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{asset('assets/plugins/jquery/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('assets/plugins/bootstrap3/js/bootstrap.min.js')}}"></script>
	<!--[if lt IE 9]>
		<script src="{{asset('assets/crossbrowserjs/html5shiv.js')}}"></script>
		<script src="{{asset('assets/crossbrowserjs/respond.min.js')}}"></script>
		<script src="{{asset('assets/crossbrowserjs/excanvas.min.js')}}"></script>
	<![endif]-->
	<script src="{{asset('assets/plugins/js-cookie/js.cookie.js')}}"></script>
	<script src="{{asset('assets/js/e-commerce/apps.min.js')}}"></script>
    <script src="{{asset('assets/plugins/parsley/dist/parsley.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-smart-wizard/src/js/jquery.smartWizard.js')}}"></script>
    <script src="{{asset('assets/js/demo/form-wizards-validation.demo.min.js')}}"></script>
    <script src="{{asset('assets/plugins/select2/dist/js/select2.min.js')}}"></script>
    <script src="{{asset('assets/plugins/sweetalert/sweetalert.min.js')}}"></script>
	<!-- ================== END BASE JS ================== -->

	<script>
	    $(document).ready(function() {
	        App.init();
            FormWizardValidation.init();
	    });
        @if (count($errors) > 0)
            $('#register').modal('show');
        @endif
        
        
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        const moneyFormat = num => {
            const n = String(num),
                p = n.indexOf('.')
            return n.replace(
                /\d(?=(?:\d{3})+(?:\.|$))/g,
                (m, i) => p < 0 || i < p ? `${m},` : m
            )
        }


        $("#password").on('keyup', function (e) {
            if (e.keyCode == 13) {
                $('a[id=loginbtn]').trigger('click');

            }
        });
        $('a[id=loginbtn]').on('click',function () {
            $('div[id=success]').show();
            $('div[id=danger]').hide();
            $.ajax({
                url: "{{route('loginuser')}}"
                ,data:{
                    _token:CSRF_TOKEN
                    ,username: $('input[id=username]').val()
                    ,password: $('input[id=password]').val()
                }
                ,type:'POST'
                ,success:function($data){
                    if(parseInt($data)){
                        setTimeout(function(){
                            location.reload();
                        },500)

                    }else{
                        $('div[id=success]').hide();
                        $('div[id=danger]').show();
                    }
                }
                ,error:function($data){
                    $('div[id=success]').hide();
                    $('div[id=danger]').show();
                    // swal("Error occured", $data, "error");

                }
            });
        });
       

	</script>

    @yield('extrajs')
</body>
</html>
