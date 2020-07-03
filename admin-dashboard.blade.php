@extends('layouts.main')

@section('title', 'Dashboard')

@push('css')
    <link href="/assets/plugins/jquery-jvectormap/jquery-jvectormap.min.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
    <link href="/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
@endpush

@section('content')
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Dashboard <small></small></h1>
        <!-- end page-header -->
        <div class="row">
            <!-- begin col-3 -->
            <div class="col-lg-3 col-md-6">
                <div class="widget widget-stats bg-success">
                    <div class="stats-icon"><i class="fa fa-shopping-basket"></i></div>
                    <div class="stats-info">
                        <h4>TOTAL PRODUCTS</h4>
                        <p>
                            {{
                               \App\r_product_info::where('PROD_DISPLAY_STATUS',1)
                               ->count()
                           }}
                        </p>
                    </div>
                    <div class="stats-link">
                        <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- end col-3 -->
            <!-- begin col-3 -->
            <div class="col-lg-3 col-md-6">
                <div class="widget widget-stats bg-purple">
                    <div class="stats-icon"><i class="fa fa-link"></i></div>
                    <div class="stats-info">
                        <h4>NEW STOCKS TODAY</h4>
                        <p>
                            {{
                                \App\r_inventory_info::whereDate('created_at',\Carbon\Carbon::today())
                                ->whereOr('INV_TYPE','ADD')
                                ->whereOr('INV_TYPE','CAPITAL')
                                ->where('INV_TYPE','<>','ORDER')
                                ->where('INV_TYPE','<>','DISPOSE')
                                ->sum('INV_QTY')
                            }}
                        </p>
                    </div>
                    <div class="stats-link">
                        <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- end col-3 -->
            <!-- begin col-3 -->
            <div class="col-lg-3 col-md-6">
                <div class="widget widget-stats bg-grey-darker">
                    <div class="stats-icon"><i class="fa fa-truck"></i></div>
                    <div class="stats-info">
                        <h4>NEW ORDERS TODAY</h4>
                        <p>
                            {{
                                \App\r_inventory_info::whereDate('created_at',\Carbon\Carbon::today())
                                ->where('INV_TYPE','<>','ADD')
                                ->where('INV_TYPE','<>','CAPITAL')
                                ->where('INV_TYPE','ORDER')
                                ->where('INV_TYPE','<>','DISPOSE')
                                ->sum('INV_QTY')
                            }}
                        </p>
                    </div>
                    <div class="stats-link">
                        <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- end col-3 -->
            <!-- begin col-3 -->
            <div class="col-lg-3 col-md-6">
                <div class="widget widget-stats bg-black-lighter">
                    <div class="stats-icon"><i class="fas fa-users"></i></div>
                    <div class="stats-info">
                        <h4>TOTAL AFFILIATES</h4>
                        <p>
                            {{
                                \App\r_affiliate_info::where('AFF_DISPLAY_STATUS',1)
                                ->count()
                            }}
                        </p>
                    </div>
                    <div class="stats-link">
                        <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- end col-3 -->
        </div>
        <!-- begin row -->
        <div class="row">
            <div class="col-md-12"
                <div id="stockGraph" style="width: 100%"></div>
            </div>
        </div>
        <!-- end row -->

@endsection

@section('extrajs')

    <script>
        {{--setTimeout(function() {--}}
            {{--$.gritter.add({--}}
                {{--title: 'Welcome back, {{Auth::user()->name}}!',--}}
                {{--text: 'Please check your dashboard.',--}}
                {{--image: '{{ Avatar::create(Auth::user()->name)->toBase64() }}',--}}
                {{--sticky: false,--}}
                {{--time: '',--}}
                {{--class_name: 'my-sticky-class'--}}
            {{--});--}}
        {{--}, 1000);--}}


        $.getJSON('{{url('/salesJSON')}}',function(data){

            Highcharts.stockChart('stockGraph', {

                rangeSelector: {
                    selected: 4
                },
                plotOptions: {
                    series: {
                        type: 'line',
                        showInNavigator: true
                    }
                },
                type: 'line',
                title: {
                    text: 'Sales'
                },

                series: [
                    {
                        name: 'Gross Sales',
                        data: $(data).map(function() { array = []; array.push([this[0],this[1]]); return array; }).get(),
                        type: 'line',
                        marker: {
                            enabled: true,
                            radius: 3
                        },
                        shadow: true,
                        tooltip: {
                            valueDecimals: 2
                        }
                    },
                    {
                        name: 'Tax Sales',
                        data: $(data).map(function() { array = []; array.push([this[0],this[2]]); return array; }).get(),
                        type: 'line',
                        marker: {
                            enabled: true,
                            radius: 3
                        },
                        shadow: true,
                        tooltip: {
                            valueDecimals: 2
                        }
                    },
                    {
                        name: 'Net Sales',
                        data: $(data).map(function() { array = []; array.push([this[0],this[3]]); return array; }).get(),
                        type: 'line',
                        marker: {
                            enabled: true,
                            radius: 3
                        },
                        shadow: true,
                        tooltip: {
                            valueDecimals: 2
                        }
                    },
                ]
            })
            });


    </script>
@endsection
