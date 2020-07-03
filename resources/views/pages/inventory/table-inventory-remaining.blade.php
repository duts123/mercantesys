@extends('layouts.main')

@section('title','Remaining Inventory')

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Remaining Inventory</a></li>
        <li class="breadcrumb-item active">List</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Remaining Inventory <small>...</small></h1>
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
    <!-- end row -->
    <!-- begin row -->
    <div class="row">

        <!-- begin col-10 -->
        <div class="col-lg-12">

            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <div class="panel-heading-btn">

                        {{--<a href="{{action('manageTax@create')}}" class="btn btn-xs btn-success"><i class="fa fa-plus-square"></i> Add item </a>--}}
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                    <h4 class="panel-title">Manage Inventory</h4>
                </div>
                <!-- end panel-heading -->

                {{--<div class="panel-body bg-black text-white"> </div>--}}
                <!-- begin alert -->

                @if(session('success') || session('error') )
                    <div class="alert alert-{{(session('success')?'success':'danger')}} fade show">
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{(session('success'))?session('success'):session('error')}}
                </div>
                @endif
                <!-- end alert -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <table id="data-table-buttons" class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 20%">Product Info</th>
                            <th>Product SKU</th>
                            <th>Acquired</th>
                            <th>Orders</th>
                            <th>Disposed</th>
                            <th style="background: #7ff77f;">Total Inventory</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($inventory as $item)
                            <tr>
                                <td data-toggle="tooltip" title="Product Information">
                                    <strong style="margin-bottom:50px">{{ $item->PROD_NAME}}</strong>
                                    <br><i style="display: -webkit-box;max-height: 3.2rem;-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;white-space: normal;-webkit-line-clamp: 2;font-weight: 500;">{{ $item->PROD_DESC }}</i>
                                    {{--<br><i style="color:orangered">Critical Value: {{ $item->PROD_CRITICAL }}</i>--}}
                                </td>
                                @php
                                    $countSKU =\App\t_product_variance::where('PROD_ID',$item->PROD_ID)->count();
                                @endphp
                                <td data-toggle="tooltip" title="Product SKU - {{$countSKU}}">
                                    <strong>
                                        <center>
                                            @if($countSKU)
                                                <a  href="{{url('inventory-remaining/'.$item->PROD_CODE)}}">{{$item->PROD_CODE}}</a>
                                            @else
                                                {{$item->PROD_CODE}}
                                            @endif
                                        </center>
                                    </strong>
                                </td>
                                <td data-toggle="tooltip" title="Total Acquired Inventory">
                                    <strong>
                                        <center>
                                            @if($countSKU)
                                                <a  href="{{url('inventory-remaining/'.$item->PROD_CODE)}}">{{$item->CAPITAL}}</a>
                                            @else
                                                <a href="#acquire{{$item->PROD_ID}}" data-toggle="modal" style="color:green">{{$item->CAPITAL}}</a>
                                            @endif
                                        </center>
                                    </strong>
                                </td>
                                <td data-toggle="tooltip" title="Total Orders"><strong><center>{{$item->ORDER}}</center></strong></td>
                                <td data-toggle="tooltip" title="Total Disposed or Dispatched">
                                    <strong>
                                        <center>
                                            @if($countSKU)
                                                <a  href="{{url('inventory-remaining/'.$item->PROD_CODE)}}">{{$item->DISPOSED}}</a>
                                            @else

                                                <a href="#dispose{{$item->PROD_ID}}" data-toggle="modal" style="color:darkred">{{$item->DISPOSED}}</a>
                                            @endif
                                        </center>
                                    </strong>
                                </td>
                                <td style="background: {{($item->PROD_CRITICAL>=$item->TOTAL)?'#ffc1c7':'#d0ffd0'}}" data-toggle="tooltip" title="Total Inventory"><strong><center>{{$item->TOTAL}}</center></strong></td>
                            </tr>
                            <div class="modal fade" id="acquire{{$item->PROD_ID}}">
                                <div class="modal-dialog" style="width:500px;">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background: #96ceff;">
                                            <h4 class="modal-title">Acquire/ Add Stocks</h4>
                                        </div>
                                        <div class="modal-body">

                                            <form method="post" action="{{url('/inventory-acquire/product')}}">
                                                {{csrf_field()}}
                                            <div class="row" style="padding-left:10px;padding-right: 10px;">
                                                <div class="alert alert-success " style="width: 100%;">
                                                    <strong>{{$item->PROD_NAME}}</strong><br>
                                                    <small>{{$item->PROD_DESC}}</small>
                                                </div>
                                                    <input name="PROD_ID" style="display: none;" value="{{$item->PROD_ID}}">
                                                    <div class="col-md-12" style="padding-bottom: 50px;">
                                                        <label>Quantity</label>
                                                        <input min=0  class="form-control" name=qty type="number" placeholder="Quantity" required>
                                                    </div>
                                                <br>
                                                <br>
                                                <br>
                                                <div class="col-md-12" style="position: absolute;bottom: 10px;left: 70%;">
                                                    <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Cancel</a>
                                                    <button  type="submit" class="btn btn-success">Save</button>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="dispose{{$item->PROD_ID}}">
                                <div class="modal-dialog" style="width:500px;">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger" >
                                            <h4 class="modal-title">Dispose/ Remove Stocks</h4>
                                        </div>
                                        <div class="modal-body">

                                            <form method="post" action="{{url('/inventory-dispose/product')}}">
                                                {{csrf_field()}}
                                                <div class="row" style="padding-left:10px;padding-right: 10px;">
                                                    <div class="alert alert-danger " style="width: 100%;">
                                                        <strong>{{$item->PROD_NAME}}</strong><br>
                                                        <small>{{$item->PROD_DESC}}</small>
                                                    </div>
                                                    <input   name="PROD_ID" style="display: none;" value="{{$item->PROD_ID}}">
                                                    <div class="col-md-12" style="padding-bottom: 50px;">
                                                        <label>Quantity</label>
                                                        <input min=0  class="form-control" name=qty type="number" placeholder="Quantity" required>
                                                    </div>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <div class="col-md-12" style="position: absolute;bottom: 10px;left: 70%;">
                                                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Cancel</a>
                                                        <button  type="submit" class="btn btn-success">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <th style="width: 20%">Product Info</th>
                            <th>Product SKU</th>
                            <th><center>{{$inventory->sum('CAPITAL')}}</center></th>
                            <th><center>{{$inventory->sum('ORDER')}}</center></th>
                            <th><center>{{$inventory->sum('DISPOSED')}}</center></th>
                            <th style="background: #7ff77f;"><center>{{$inventory->sum('TOTAL')}}</center></th>
                        </tfoot>
                    </table>
                </div>
                <!-- end panel-body -->
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-10 -->
    </div>



@endsection

@section('extrajs')

    <script>

        $('#data-table-buttons').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            "aaSorting": [[3, "desc" ]]
            ,dom: 'lBfrtip'
            ,   buttons: [
                { extend: 'copy', className: 'btn-sm',
                    exportOptions: {
                        columns: [1,2,3,4,5]
                    }
                },
                { extend: 'csv', className: 'btn-sm' ,
                    exportOptions: {
                        columns: [1,2,3,4,5]
                    }
                },
                { extend: 'excel', className: 'btn-sm',
                    exportOptions: {
                        columns: [1,2,3,4,5]
                    }
                },
                { extend: 'pdf', className: 'btn-sm',
                    exportOptions: {
                        columns: [1,2,3,4,5]
                    }
                },
                { extend: 'print', className: 'btn-sm',
                    exportOptions: {
                        columns: [1,2,3,4,5]
                    }
                },


            ],
        });


    </script>
@endsection
