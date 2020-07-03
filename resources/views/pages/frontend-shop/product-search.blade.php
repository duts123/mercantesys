@extends('layouts.frontend-main')

@section('title','Products')

@section('content')

    <!-- BEGIN #page-header -->
    <div id="page-header" class="section-container page-header-container bg-black">
        <!-- BEGIN page-header-cover -->
        <div class="page-header-cover">
            <img src="../assets/img/cover/cover-13.jpg" alt="" />
        </div>
        <!-- END page-header-cover -->
        <!-- BEGIN container -->
        <div class="container">
            <h1 class="page-header">Search Results for "<b>{{$search}}</b>"</h1>
        </div>
        <!-- END container -->
    </div>
    <!-- BEGIN #page-header -->

    <!-- BEGIN search-results -->
    <div id="search-results" class="section-container bg-silver">
        <!-- BEGIN container -->
        <div class="container">
            <!-- BEGIN search-container -->
            <div class="search-container">
                <!-- BEGIN search-content -->
                <div class="search-content">
                    <!-- BEGIN search-toolbar -->
                    <div class="search-toolbar">
                        <!-- BEGIN row -->
                        <div class="row">
                            <!-- BEGIN col-6 -->
                            <div class="col-md-6">
                                <h4>We found {{count($searchResult)}} Items for "{{$search}}"</h4>
                            </div>
                            <!-- END col-6 -->
                            <!-- BEGIN col-6 -->
                            <div class="col-md-6 text-right">
                                <ul class="sort-list">
                                    <li class="text"><i class="fa fa-filter"></i> Sort by:</li>
                                    <li class="active"><a href="#">Popular</a></li>
                                    <li><a href="#">New Arrival</a></li>
                                    <li><a href="#">Discount</a></li>
                                    <li><a href="#">Price</a></li>
                                </ul>
                            </div>
                            <!-- END col-6 -->
                        </div>
                        <!-- END row -->
                    </div>
                    <!-- END search-toolbar -->
                    <!-- BEGIN search-item-container -->
                    <div class="search-item-container">

                        @php $i=1 @endphp
                        @foreach($searchResult as $item)
                            <!-- BEGIN item-row -->
                            @if( $i%3==1)
                            <div class="item-row">
                            @endif
                            <!-- BEGIN item -->
                            <div class="item item-thumbnail">
                                <a href="{{url('product/details/'.$item->PROD_ID)}}" class="item-image">
                                <img src="{{($item->PROD_IMG==null||!file_exists($item->PROD_IMG))?asset('uPackage.png'):asset($item->PROD_IMG)}}" alt="" />
                                <div class="discount" >{{$discount=$item->PROD_DISCOUNT}}% OFF</div>
                                </a>
                            <div class="item-info">
                                <h4 class="item-title">
                                    <a href="{{url('product/details/'.$item->PROD_ID)}}">{{$item->PROD_NAME}}<br />
                                    <span style="color:gray">{{$item->rAffiliateInfo->AFF_NAME}}</span></a>
                                </h4>
                                    <p class="item-desc"  title="{{$item->PROD_DESC}}">{{$item->PROD_DESC}}</p>
                                <div class="item-price">
                                    {{$item->PRICE}}
                                </div>
                                    <div class="item-discount-price">
                                    {{$item->DISCOUNT}}
                                    </div>
                                </div>
                            </div>
                            <!-- END item -->

                            @if($i%3==0 || count($searchResult)==$i )
                            </div>
                            <!-- END item-row -->
                            @endif

                            @php $i++ @endphp
                        @endforeach


                    </div>
                    <!-- END search-item-container -->

                </div>
                <!-- END search-content -->
                <!-- BEGIN search-sidebar -->
                <div class="search-sidebar">
                    <h4 class="title">Filter By</h4>
                    <form action="{{url('search')}}" method="GET" name="filter_form">
                        <div class="form-group">
                            <label class="control-label">Keywords</label>
                            <input  name=search type="text" class="form-control input-sm" name="keyword" value="{{$search}}" placeholder="Enter Keywords" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">Price</label>
                            <div class="row row-space-0">
                                <div class="col-md-5">
                                    <input required type="number" class="form-control input-sm" name="price_from" value="{{($price_from)?$price_from:10}}" placeholder="Price From" />
                                </div>
                                <div class="col-md-2 text-center p-t-5 f-s-12 text-muted">to</div>
                                <div class="col-md-5">
                                    <input required type="number" class="form-control input-sm" name="price_to" value="{{($price_to)?$price_to:1000}}" placeholder="Price To" />
                                </div>
                            </div>
                        </div>
                        <div class="m-b-30">
                            <button type="submit" class="btn btn-sm btn-inverse"><i class="fa fa-search"></i> Filter</button>
                        </div>
                    </form>
                    <ul class="search-category-list">

                        <h4 class="title  ">Affiliates</h4>

                            @foreach($aff as $item)
                                <li style="padding-left: 5%;">
                                    <a href="javascript:;" id="btn_getProdAff" value="{{$item->AFF_ID}}">
                                        {{$item->AFF_NAME}}
                                    </a>
                                </li>
                            @endforeach
                        <br>
                        <br>
                        <h4 class="title  ">Categories</h4>
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
                <!-- END search-sidebar -->
            </div>
            <!-- END search-container -->
        </div>
        <!-- END container -->
    </div>
    <!-- END search-results -->

@endsection
@section('extrajs')


@endsection
