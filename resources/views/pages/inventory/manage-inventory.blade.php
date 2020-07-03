@extends('layouts.main')

@section('title','Manage Inventory')

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
    <!-- begin row -->
    <div class="row">

        <!-- begin col-10 -->
        <div class="col-lg-12">

            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <div class="panel-heading-btn">

                        <a href="{{action('manageTax@create')}}" class="btn btn-xs btn-success"><i class="fa fa-plus-square"></i> Add item </a>
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
                            <tr style="background: {{($item->PROD_CRITICAL>=$item->TOTAL)?'#ffc1c7':'#d0ffd0'}}">
                                <td>
                                    <strong style="margin-bottom:50px">{{ $item->PROD_NAME}}</strong>
                                    <br><i style="display: -webkit-box;max-height: 3.2rem;-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis;white-space: normal;-webkit-line-clamp: 2;font-weight: 500;">{{ $item->PROD_DESC }}</i>
                                    <br><i style="color:orangered">Critical Value: {{ $item->PROD_CRITICAL }}</i>
                                </td>
                                <td><strong><center><a href="{{url('inventory-remaining/'.$item->PROD_CODE)}}">{{$item->PROD_CODE}}</a></center></strong></td>
                                <td><strong><center>{{$item->CAPITAL}}</center></strong></td>
                                <td><strong><center>{{$item->ORDER}}</center></strong></td>
                                <td><strong><center>{{$item->DISPOSED}}</center></strong></td>
                                <td><strong><center>{{$item->TOTAL}}</center></strong></td>
                            </tr>
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
