
@extends('layouts.frontend-main')

@section('title','Products')

@section('content')

    <style>
        .item-row{
            display:flex;
        }
        #showall{
            display:none;
        }
        @media (max-width: 480px){
            .item-row{
                display:block;
            }
            #showall{
                display:block;
            }
        }

    </style>
      <!-- BEGIN #slider -->
      <div id="slider" class="section-container p-0 bg-black-darker">
            <!-- BEGIN carousel -->
            <div id="main-carousel" class="carousel slide" data-ride="carousel">
                <!-- BEGIN carousel-inner -->
                <div class="carousel-inner">
                @php $i=1 @endphp
                    @foreach($Allprod as $item)
                    <!-- BEGIN item -->
                    <div class="item {{($i==1)?'active':''}}">
                        <img src="{{asset('assets/img/slider/slider-2-cover.jpg')}}" class="bg-cover-img" alt="" />
                        <div class="container">
                            <img style="background: #ffffff85;" src="{{($item->PROD_IMG==null||!file_exists($item->PROD_IMG))?asset('uPackage.png'):asset($item->PROD_IMG)}}" class="product-img left bottom fadeInLeft animated" alt="" />
                        </div>
                        <div class="carousel-caption carousel-caption-right">
                            <div class="container">
                                <h3 class="title m-b-5 fadeInRightBig animated">{{$item->PROD_NAME}}</h3>
                                <p class="m-b-15 fadeInRightBig animated">{{$item->PROD_DESC}}</p>
                                <div class="price m-b-30 fadeInRightBig animated"><small>from</small>
                                    <span>
                                        {{$item->PRICE}}
                                    </span>

                                    @if($item->DISCOUNT)<div class="item-discount-price" style="text-decoration:line-through; ">{{$item->DISCOUNT}}</div>@endif
                                </div>
                                <a href="{{url('product/details/'.$item->PROD_ID)}}" class="btn btn-outline btn-lg fadeInRightBig animated">View</a>
                            </div>
                        </div>
                    </div>
                    <!-- END item -->
                        @php $i++ @endphp
                    @endforeach
                </div>
                <!-- END carousel-inner -->
                <a class="left carousel-control" href="#main-carousel" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="right carousel-control" href="#main-carousel" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
            <!-- END carousel -->
        </div>
        <!-- END #slider -->


        <!-- BEGIN #trending-items -->
        <div id="trending-items" class="section-container bg-silver">
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN section-title -->
                <h4 class="section-title clearfix">
                    <!-- <a href="#" class="pull-right m-l-5"><i class="fa fa-angle-right f-s-18"></i></a>
                    <a href="#" class="pull-right"><i class="fa fa-angle-left f-s-18"></i></a> -->

                    <a href="#" class="pull-right">SHOW ALL</a>
                    Trending Products
                    <small>Shop and get gifts for your friends and your family!</small>
                </h4>
                <!-- END section-title -->

                <!-- BEGIN row -->
                <div class="row row-space-10">

                    @foreach($Allprod->take(6) as $item)
                    <!-- BEGIN col-2 -->
                    <div class="col-md-2 col-sm-4">
                        <!-- BEGIN item -->
                        <div class="item item-thumbnail">
                            <a href="{{asset('')}}product/details/{{$item->PROD_ID}}" class="item-image">
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
                <!-- END row -->
            </div>
            <!-- END container -->
        </div>
        <!-- END #trending-items -->

        <!-- BEGIN #mobile-list -->
        <div id="mobile-list" class="section-container bg-silver p-t-0">
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN section-title -->
                <h4 class="section-title clearfix">
                    <a id=showall href="#" class="pull-right">SHOW ALL</a>
                    All Products
                    <small>Shop and get gifts for your friends and your family!</small>
                </h4>
                <!-- END section-title -->
                <!-- BEGIN category-container -->
                <div class="category-container">
                    <!-- BEGIN category-sidebar -->
                    <div class="category-sidebar">
                        <ul class="category-list">
                            <li style="padding-left: 5%; background: rgba(128, 128, 128, 0.37)">
                                <a href="javascript:;"  id="btn_getProdAff" value="{{$item->AFF_ID}}">
                                    Show All
                                </a>
                            </li>
                            <br>
                            <li class="list-header">All Affiliates</li>

                            @foreach($aff as $item)
                                <li style="padding-left: 5%;">
                                    <a href="javascript:;" id="btn_getProdAff" value="{{$item->AFF_ID}}">
                                        {{$item->AFF_NAME}}
                                    </a>
                                </li>
                            @endforeach
                            <br>
                            <li class="list-header">All Categories</li>
                            {{--<li style="padding-left: 5%; background: rgba(128, 128, 128, 0.37)">--}}
                                {{--<a href="javascript:;"  id="btn_getProdCat" value="0">--}}
                                    {{--Show All--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            @foreach($cat->where('PRODT_PARENT','<>',null) as $item)

                                <li style="padding-left: 5%;" title="{{$item->rProductType->PRODT_TITLE}}" >
                                    <a href="javascript:;"  id="btn_getProdCat" value="{{$item->PRODT_ID}}">
                                        {{$item->PRODT_TITLE}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- END category-sidebar -->
                    <!-- BEGIN category-detail -->
                    <div class="category-detail" style="height: 700px;overflow-y:scroll ">

                        <!-- BEGIN category-item -->
                        <div class="category-item list">

                        </div>
                        <!-- END category-item -->
                    </div>
                    <!-- END category-detail -->
                </div>
                <!-- END category-container -->
            </div>
            <!-- END container -->
        </div>
        <!-- END #mobile-list -->

        {{--<!-- BEGIN #tablet-list -->--}}
        {{--<div id="tablet-list" class="section-container bg-silver p-t-0">--}}
            {{--<!-- BEGIN container -->--}}
            {{--<div class="container">--}}
                {{--<!-- BEGIN section-title -->--}}
                {{--<h4 class="section-title clearfix">--}}
                    {{--<a href="#" class="pull-right">SHOW ALL</a>--}}
                    {{--Categories--}}
                    {{--<small>Shop and get gifts for your friends and your family!</small>--}}
                {{--</h4>--}}
                {{--<!-- END section-title -->--}}
                {{--<!-- BEGIN category-container -->--}}
                {{--<div class="category-container">--}}
                    {{--<!-- BEGIN category-sidebar -->--}}
                    {{--<div class="category-sidebar">--}}
                        {{--<ul class="category-list">--}}
                            {{--<li class="list-header">All Categories</li>--}}
                            {{--<li style="padding-left: 5%; background: rgba(128, 128, 128, 0.37)">--}}
                                {{--<a href="javascript:;"  id="btn_getProdCat" value="0">--}}
                                    {{--Show All--}}
                                {{--</a>--}}
                            {{--</li>--}}
                        {{--@foreach($cat->where('PRODT_PARENT','<>',null) as $item)--}}

                                {{--<li style="padding-left: 5%;" title="{{$item->rProductType->PRODT_TITLE}}" >--}}
                                    {{--<a href="javascript:;"  id="btn_getProdCat" value="{{$item->PRODT_ID}}">--}}
                                        {{--{{$item->PRODT_TITLE}}--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                        {{--@endforeach--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                    {{--<!-- END category-sidebar -->--}}
                    {{--<!-- BEGIN category-detail -->--}}
                    {{--<div class="category-detail">--}}
                        {{--<!-- BEGIN category-item -->--}}
                        {{--<!-- <a href="#" class="category-item full">--}}
                            {{--<div class="item">--}}
                                {{--<div class="item-cover">--}}
                                    {{--<img src="{{asset('uPackage.png')}}" alt="" />--}}
                                {{--</div>--}}
                                {{--<div class="item-info bottom">--}}
                                    {{--<h4 class="item-title">Huawei MediaPad T1 7.0</h4>--}}
                                    {{--<p class="item-desc">Vibrant colors. Beautifully displayed</p>--}}
                                    {{--<div class="item-price">$299.00</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</a> -->--}}
                        {{--<!-- END category-item -->--}}
                        {{--<!-- BEGIN category-item -->--}}
                        {{--<div class="category-item list">--}}

                        {{--@php $i=1 @endphp--}}
                        {{--@foreach($Allprod as $item)--}}
                            {{--<!-- BEGIN item-row -->--}}
                            {{--@if( $i%3==1)--}}
                                    {{--<div class="item-row">--}}
                                    {{--@endif--}}
                                    {{--<!-- BEGIN item -->--}}
                                        {{--<div class="item item-thumbnail">--}}
                                            {{--<a href="{{url('product/details/'.$item->PROD_ID)}}" class="item-image">--}}
                                                {{--<img src="{{($item->PROD_IMG==null||!file_exists($item->PROD_IMG))?asset('uPackage.png'):asset($item->PROD_IMG)}}" alt="" />--}}
                                                {{--<div class="discount" >{{$discount=$item->PROD_DISCOUNT}}% OFF</div>--}}
                                            {{--</a>--}}
                                            {{--<div class="item-info">--}}
                                                {{--<h4 class="item-title">--}}
                                                    {{--<a href="{{url('product/details/'.$item->PROD_ID)}}">{{$item->PROD_NAME}}<br />--}}
                                                        {{--<span style="color:gray">{{$item->rAffiliateInfo->AFF_NAME}}</span></a>--}}
                                                {{--</h4>--}}
                                                {{--<p class="item-desc"  title="{{$item->PROD_DESC}}">{{$item->PROD_DESC}}</p>--}}
                                                {{--<div class="item-price">--}}
                                                    {{--{{$item->PRICE}}--}}
                                                {{--</div>--}}
                                                {{--<div class="item-discount-price">--}}
                                                    {{--{{$item->DISCOUNT}}--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<!-- END item -->--}}

                                        {{--@if($i%3==0 || count($Allprod)==$i )--}}
                                    {{--</div>--}}
                                    {{--<!-- END item-row -->--}}
                                {{--@endif--}}

                                {{--@php $i++ @endphp--}}
                            {{--@endforeach--}}

                        {{--</div>--}}
                        {{--<!-- END category-item -->--}}
                    {{--</div>--}}
                    {{--<!-- END category-detail -->--}}
                {{--</div>--}}
                {{--<!-- END category-container -->--}}
            {{--</div>--}}
            {{--<!-- END container -->--}}
        {{--</div>--}}
        {{--<!-- END #tablet-list -->--}}


                    </div>
                    <!-- END col-4 -->
                </div>
                <!-- END row -->
            </div>
            <!-- END container -->
        </div>
        <!-- END #policy -->

        <!-- BEGIN #subscribe -->
        <div id="subscribe" class="section-container bg-silver p-t-30 p-b-30">
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN row -->
                <div class="row">
                    <!-- BEGIN col-6 -->
                    <div class="col-md-6 col-sm-6">
                        <!-- BEGIN subscription -->
                        <div class="subscription">
                            <div class="subscription-intro">
                                <h4> LET'S STAY IN TOUCH</h4>
                                <p>Get updates on sales specials and more</p>
                            </div>
                            <div class="subscription-form">
                                <form name="subscription_form" action="index.html" method="POST">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="email" placeholder="Enter Email Address" />
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-inverse"><i class="fa fa-angle-right"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- END subscription -->
                    </div>
                    <!-- END col-6 -->
                    <!-- BEGIN col-6 -->
                    <div class="col-md-6 col-sm-6">
                        <!-- BEGIN social -->
                        <div class="social">
                            <div class="social-intro">
                                <h4>FOLLOW US</h4>
                                <p>We want to hear from you!</p>
                            </div>
                            <div class="social-list">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-dribbble"></i></a>
                                <a href="#"><i class="fa fa-google-plus"></i></a>
                            </div>
                        </div>
                        <!-- END social -->
                    </div>
                    <!-- END col-6 -->
                </div>
                <!-- END row -->
            </div>
            <!-- END container -->
        </div>
        <!-- END #subscribe -->
    @section('extrajs')


        {{--btn_getProdAff--}}
        <script>
            $(document).ready(function(){
                $('#btn_getProdAff[value=0]').trigger('click');
            });
            $('a[id=btn_getProdAff]').on('click',function(){
                $btn = $(this);
                id = $($btn).attr('value');
                 // '/getProd/Affiliates/'+$id {{URL::to('/getProd/Affiliates/0')}}
                
                $.ajax({
                    url: "{{route('prodAffiliates')}}"
                    ,type: 'post'
                    ,data: {_token:CSRF_TOKEN,id:id }
                    ,dataType:'json'
                    ,success:function($data){

                        $.each($($btn).closest('li').closest('ul'),function(){
                            $(this).find('li').css('background','#ffffff');
                        });
                        $($btn).closest('li').css('background','#8080805e');
                        $($btn).closest('li').closest('ul').closest('div').closest('.category-container').find('.category-detail').find('.category-item').html(" ");
                        $i=1;
                        $datas = "";
                        $.each($data,function(id,val){
                            $start="";
                            $end="";
                            $pic="/uPackage.png";
                            $discText= " ";
                            if($i%3==1)
                                $start="<div class='item-row'>";
                            if($i%3==0 || $data.count )
                                $end="</div>";
                            if(val.PROD_IMG)
                                $pic=val.PROD_IMG;

                            if(val.PROD_DISCOUNT)
                                $discText = "<div class='discount' >"+val.PROD_DISCOUNT+"% OFF</div>";

                            $datas += $start+"<div class='item item-thumbnail'> <a href='{{asset('')}}product/details/"+val.PROD_ID+"' class='item-image'> <img src='"+$pic+"' />"+$discText+"</a> <div class='item-info'> <h4 class='item-title'>  <a href='{{asset('')}}product/details/"+val.PROD_ID+"'>"+val.PROD_NAME+"<br /> <span style='color:gray'>"+val.AFF_NAME+"</span></a>" +
                                "</h4> <p class='item-desc'  title='"+val.PROD_DESC+"'>"+val.PROD_DESC+"</p> <div class='item-price'>"+val.PRICE+"</div>" +
                                "<div class='item-discount-price'>"+val.DISCOUNT+"</div></div> </div>"+$end;
                            $i++;
                        });
                        if($data=='')
                            $datas = "<center style='padding: 13%;color:lightgray'> Nothing to show</center>";
                        $($btn).closest('li').closest('ul').closest('div').closest('.category-container').find('.category-detail').find('.category-item').html($datas);
                        

                    }
                    ,error:function($e){
                        // window.location.href=$e;
                        // alert($id);

                        console.error($e);

                    }
                });
            });
        </script>



        <script>
            $('a[id=btn_getProdCat]').on('click',function(){
                $btn = $(this);
                id = $($btn).attr('value');

                // {{URL::to('/getProd/Category/$id')}}
                $.ajax({    
                    url: "{{route('getCategory')}}"
                    ,type: 'post'
                    ,data: {_token:CSRF_TOKEN, id:id }
                    ,dataType:'json'
                    ,success:function($data){
                        $.each($($btn).closest('li').closest('ul'),function(){
                            $(this).find('li').css('background','#ffffff');
                        });
                       
                        $($btn).closest('li').css('background','#8080805e');
                        $($btn).closest('li').closest('ul').closest('div').closest('.category-container').find('.category-detail').find('.category-item').html(" ");
                        var $i=1;
                        $datas = "<div >";
                        $discText= " ";
                        $.each($data,function(id,val){
                            $start="";
                            $end="";
                            $pic="/uPackage.png";
                            if($i%3==1)
                                $start="<div class='item-row'>";
                            if($i%3==0 || $data.count )
                                $end="</div>";
                            if(val.PROD_IMG)
                                $pic=val.PROD_IMG;
                            if(val.PROD_DISCOUNT)
                                $discText = "<div class='discount' >"+val.PROD_DISCOUNT+"% OFF</div>";

                            $datas += $start+"<div class='item item-thumbnail'> <a href='{{asset('')}}product/details/"+val.PROD_ID+"' class='item-image'> <img src='"+$pic+"' />"+$discText+"</a> <div class='item-info'> <h4 class='item-title'>  <a href='{{asset('')}}product/details/"+val.PROD_ID+"'>"+val.PROD_NAME+"<br /> <span style='color:gray'>"+val.r_affiliate_info.AFF_NAME+"</span></a>" +
                                "</h4> <p class='item-desc'  title='"+val.PROD_DESC+"'>"+val.PROD_DESC+"</p> <div class='item-price'>"+val.PRICE+"</div>" +
                                "<div class='item-discount-price'>"+val.DISCOUNT+"</div></div> </div>"+$end;
                            $i++;
                        });
                        if($data=='')
                            $datas = "<center style='padding: 13%;color:lightgray'> Nothing to show</center>";
                        $($btn).closest('li').closest('ul').closest('div').closest('.category-container').find('.category-detail').find('.category-item').html($datas);

                    }
                    ,error:function($e){
                        window.location.href=$e;
                        alert('error sa pagclick ng product');
                    }
                });
            });
            </script>
    @endsection

@endsection
