@extends('layouts.main')

@section('title','Stock Keeping Unit')

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Stock Keeping Unit</a></li>
        <li class="breadcrumb-item active">List</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Stock Keeping Unit <small> {{$prod->PROD_CODE}}</small></h1>
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

{{--                        <a href="{{action('manageTax@create')}}" class="btn btn-xs btn-success"><i class="fa fa-plus-square"></i> Add item </a>--}}
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                    <h4 class="panel-title">Stock Keeping Unit</h4>
                </div>
                <!-- end panel-heading -->

            <div class="panel-body bg-black text-white">
                <div class="row">
                    <div class="col-md-6">
                        <a  href="{{url('inventory-remaining')}}"><h3 class="text-white">{{$prod->PROD_NAME}}</h3></a>
                        <i style="font-size: 12px" class="text-white"> {{$prod->PROD_NAME}}</i>
                        <br><span style="font-size: 15px" class="text-white"></span>
                    </div>
                    <div class="col-md-6">
                        <span>Total Remaining Inventory, including the products and its variance. </span><span style="font-size: 26px;background: gray;font-weight: bolder;padding: 2px;">{{Sympies::returnProdInventory()->where('PROD_ID',$prod->PROD_ID)->sum('TOTAL')}}</span>
                    </div>
                </div>

            </div>
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
                            <th style="width: 20%">Product Variance Info</th>
                            <th>Product Variance SKU</th>
                            <th>Acquired</th>
                            <th>Orders</th>
                            <th>Disposed</th>
                            <th>Total Variance Inventory</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <strong style="margin-bottom:50px">{{ $prod->PROD_NAME}}</strong>
                                <br><i style="display: -webkit-box;max-height: 3.2rem;-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;white-space: normal;-webkit-line-clamp: 2;font-weight: 500;">{{ $prod->PROD_DESC }}</i>
                            </td>
                            <td><strong><center>{{$prod->PROD_CODE}}</center></strong></td>
                            <td data-toggle="tooltip" title="Total Acquired Inventory"><strong><center><a href="#acquire{{$prod->PROD_ID}}" data-toggle="modal" style="color:green">{{$prod->CAPITAL}}</a></center></strong></td>
                            <td data-toggle="tooltip" title="Total Orders"><strong><center>{{$prod->ORDER}}</center></strong></td>
                            <td data-toggle="tooltip" title="Total Disposed or Dispatched"><strong><center><a href="#dispose{{$prod->PROD_ID}}" data-toggle="modal" style="color:darkred">{{$prod->DISPOSED}}</a></center></strong></td>
                            <td><strong><center>{{$prod->TOTAL}}</center></strong></td>

                            <div class="modal fade" id="acquire{{$prod->PROD_ID}}">
                                <div class="modal-dialog" style="width:500px;">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background: #96ceff;">
                                            <h4 class="modal-title">Acquire/ Add Stocks</h4>
                                        </div>
                                        <div class="modal-body">

                                            <form method="post" action="{{url('/inventory-acquire/variance')}}">
                                                {{csrf_field()}}
                                                <div class="row" style="padding-left:10px;padding-right: 10px;">
                                                    <div class="alert alert-success " style="width: 100%;">
                                                        <strong>{{$prod->PROD_NAME}}</strong><br>
                                                        <small>{{$prod->PROD_DESC}}</small>
                                                    </div>
                                                    <input name="PROD_ID" style="display: none;" value="{{$prod->PROD_ID}}">
                                                    <input name="PRODV_ID" style="display: none;" value="">
                                                    <div class="col-md-12" style="padding-bottom: 50px;">
                                                        <label>Quantity</label>
                                                        <input class="form-control" name=qty type="number" placeholder="Quantity" required>
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

                            <div class="modal fade" id="dispose{{$prod->PROD_ID}}">
                                <div class="modal-dialog" style="width:500px;">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger" >
                                            <h4 class="modal-title">Dispose/ Remove Stocks</h4>
                                        </div>
                                        <div class="modal-body">

                                            <form method="post" action="{{url('/inventory-dispose/variance')}}">
                                                {{csrf_field()}}
                                                <div class="row" style="padding-left:10px;padding-right: 10px;">
                                                    <div class="alert alert-danger " style="width: 100%;">
                                                        <strong>{{$prod->PROD_NAME}}</strong><br>
                                                        <small>{{$prod->PROD_DESC}}</small>
                                                    </div>
                                                    <input name="PROD_ID" style="display: none;" value="{{$prod->PROD_ID}}">
                                                    <input name="PRODV_ID" style="display: none;" value="">
                                                    <div class="col-md-12" style="padding-bottom: 50px;">
                                                        <label>Quantity</label>
                                                        <input class="form-control" name=qty type="number" placeholder="Quantity" required>
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
                        </tr>
                        @foreach($prodvar as $item)
                            <tr  >
                                <td>
                                    <strong style="margin-bottom:50px">{{ $item->PRODV_NAME}}</strong>
                                    <br><i style="display: -webkit-box;max-height: 3.2rem;-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;white-space: normal;-webkit-line-clamp: 2;font-weight: 500;">{{ $item->PRODV_DESC }}</i>
                                </td>
                                <td><strong><center>{{$item->PRODV_SKU}}</center></strong></td>
                                <td data-toggle="tooltip" title="Total Acquired Inventory"><strong><center><a href="#acquire{{$item->PRODV_ID}}" data-toggle="modal" style="color:green">{{$item->CAPITAL}}</a></center></strong></td>
                                <td data-toggle="tooltip" title="Total Orders"><strong><center>{{$item->ORDER}}</center></strong></td>
                                <td data-toggle="tooltip" title="Total Disposed or Dispatched"><strong><center><a href="#dispose{{$item->PRODV_ID}}" data-toggle="modal" style="color:darkred">{{$item->DISPOSED}}</a></center></strong></td>
                                <td><strong><center>{{$item->TOTAL}}</center></strong></td>

                                <div class="modal fade" id="acquire{{$item->PRODV_ID}}">
                                    <div class="modal-dialog" style="width:500px;">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background: #96ceff;">
                                                <h4 class="modal-title">Acquire/ Add Stocks</h4>
                                            </div>
                                            <div class="modal-body">

                                                <form method="post" action="{{url('/inventory-acquire/variance')}}">
                                                    {{csrf_field()}}
                                                    <div class="row" style="padding-left:10px;padding-right: 10px;">
                                                        <div class="alert alert-success " style="width: 100%;">
                                                            <strong>{{$item->PRODV_NAME}}</strong><br>
                                                            <small>{{$item->PRODV_DESC}}</small>
                                                        </div>
                                                        <input name="PROD_ID" style="display: none;" value="{{$prod->PROD_ID}}">
                                                        <input name="PRODV_ID" style="display: none;" value="{{$item->PRODV_ID}}">
                                                        <div class="col-md-12" style="padding-bottom: 50px;">
                                                            <label>Quantity</label>
                                                            <input class="form-control" name=qty type="number" placeholder="Quantity" required>
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

                                <div class="modal fade" id="dispose{{$item->PRODV_ID}}">
                                    <div class="modal-dialog" style="width:500px;">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger" >
                                                <h4 class="modal-title">Dispose/ Remove Stocks</h4>
                                            </div>
                                            <div class="modal-body">

                                                <form method="post" action="{{url('/inventory-dispose/variance')}}">
                                                    {{csrf_field()}}
                                                    <div class="row" style="padding-left:10px;padding-right: 10px;">
                                                        <div class="alert alert-danger " style="width: 100%;">
                                                            <strong>{{$item->PRODV_NAME}}</strong><br>
                                                            <small>{{$item->PRODV_DESC}}</small>
                                                        </div>
                                                        <input name="PROD_ID" style="display: none;" value="{{$prod->PROD_ID}}">
                                                        <input name="PRODV_ID" style="display: none;" value="{{$item->PRODV_ID}}">
                                                        <div class="col-md-12" style="padding-bottom: 50px;">
                                                            <label>Quantity</label>
                                                            <input class="form-control" name=qty type="number" placeholder="Quantity" required>
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
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <th style="width: 20%">Product Variance Info</th>
                        <th>Product Variance SKU</th>
                        <th><center>{{$prodvar->sum('CAPITAL')+$prod->CAPITAL}}</center></th>
                        <th><center>{{$prodvar->sum('ORDER')+$prod->ORDER}}</center></th>
                        <th><center>{{$prodvar->sum('DISPOSED')+$prod->DISPOSED}}</center></th>
                        <th><center>{{$prodvar->sum('TOTAL')+$prod->TOTAL}}</center></th>
                        </tfoot>
                    </table>
                </div>
                <!-- end panel-body -->
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-10 -->
    </div>
    <!-- end row -->
    <div class="modal modal-message fade" id="taxreferencesetup" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Product Tax</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <form method="post" id="taxModal" action="{{url('tax')}}"  enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="POST" />
                        <div class="row">

                            <div class="col-md-12" style="padding-bottom: 20px;">
                                <strong>Are you sure? you want to edit this record?</strong>
                                <p>Please provide the following inputs to validate the record.</p>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" name=taxname placeholder="Name" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Rate</label>
                                    <input class="form-control" name=taxrate type="number" placeholder="Rate" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Type</label>
                                    <select class="form-control " name="taxtype" style="width: 100%;" required>
                                        <option selected="selected"  disabled>Please Select Type</option>
                                        <option value=0 >Percentage</option>
                                        <option value=1 >Fixed</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name=taxdesc style="resize:vertical; width:100%;height:107px" placeholder="Description" required></textarea>
                                </div>
                            </div>
                            <!-- /.row -->
                            <div class="col-md-12" >
                                <div class="pull-right" style="margin-right: 10px;">
                                    <button class="btn btn-success" type="submit" >Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
