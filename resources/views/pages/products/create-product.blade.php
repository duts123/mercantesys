@extends('layouts.main')

@section('title','Product Create')

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Manage Products</a></li>
        <li class="breadcrumb-item active">create</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Create Products <small>products provided by different affiliates...</small></h1>
    <!-- end page-header -->

    <!-- begin row -->
    <div class="row">
        <!-- begin col-2 -->

        <!-- end col-2 -->
        <!-- begin col-10 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <div class="panel-heading-btn">

                        <a class="btn btn-xs btn-success" href="{{action('manageProduct@index')}}"><i class="fa fa-list"></i> List </a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                    <h4 class="panel-title">Create Product</h4>
                </div>
                <!-- end panel-heading -->
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
                    <div class="panel-body panel-form">
                        <form class="form-horizontal form-bordered" method="post" action="{{ action('manageProduct@store')}}"  enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Product Code</label>
                                    <div class="input-group m-b-10">
                                        <div class="input-group-prepend"><span class="input-group-text">*</span></div>
                                        <input class="form-control" name=prodcode readonly="readonly" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Product Name</label>
                                    <div class="input-group m-b-10">
                                        <div class="input-group-prepend"><span class="input-group-text">*</span></div>
                                        <input class="form-control" name=prodname placeholder="Product Name" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Product Category</label>
                                    <select class="form-control productType" name="prodtype" style="width: 100%;" required >
                                        <option  value="" disabled>Please Select Product Category</option>
                                        @foreach($prodType->where('PRODT_PARENT',null)->where('PRODT_DISPLAY_STATUS',1) as $item)
                                            <optgroup label="{{$item->PRODT_TITLE}}">
                                                @foreach($prodType->where('PRODT_PARENT',$item->PRODT_ID)->where('PRODT_DISPLAY_STATUS',1) as $item1)
                                                    <option value="{{$item1->PRODT_ID}}">{{$item1->PRODT_TITLE}}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                @if(strtolower(\Illuminate\Support\Facades\Auth::user()->role)=='admin')
                                <div class="col-md-6">
                                    <label>Affiliate</label>
                                    <select class="form-control " name="affiliate" style="width: 100%;" required>
                                        <option selected="selected" value=""  disabled>Please Select Affiliate</option>
                                        @foreach($aff as $item)
                                            <option value={{$item->AFF_ID}}>{{$item->AFF_NAME}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Product My Price (Sympies)</label>
                                    <div class="input-group m-b-10">
                                        <div class="input-group-prepend"><span class="input-group-text">*</span></div>
                                        <input type="number" placeholder="0" min='0' name="prodmyprice" class="form-control" required>
                                        <div class="input-group-append"><span class="input-group-text" id="markupstat">#</span></div>
                                    </div>
                                </div>
                                @else
                                    <div class="col-md-6" style="display: none;">
                                        <label>Affiliate</label>
                                        <select class="form-control " name="affiliate" style="width: 100%;" required>
                                            <option value=""  disabled>Please Select Affiliate</option>
                                            @foreach($aff as $item)
                                                <option {{(Auth::user()->AFF_ID==$item->AFF_ID)?'selected="selected"':''}} value={{$item->AFF_ID}}>{{$item->AFF_NAME}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                <div class="col-md-3">
                                    <label>Product Base Price (Affiliate)</label>
                                    <div class="input-group m-b-10">
                                        <div class="input-group-prepend"><span class="input-group-text">*</span></div>
                                        <input type="number" placeholder="0" name="baseprice" class="form-control" required >
                                        <div class="input-group-append"><span class="input-group-text">#</span></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Availablabiliy</label>
                                        <div class="input-group input-daterange  m-b-10">
                                            <input type="text" class="form-control" name="start" placeholder="Date Start" />
                                            <span class="input-group-addon">to</span>
                                            <input type="text" class="form-control" name="end" placeholder="Date End" />
                                        </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Discount</label>
                                    <div class="input-group m-b-10">
                                        <div class="input-group-prepend"><span class="input-group-text">*</span></div>
                                        <input type="number" placeholder="0" name="discount" class="form-control" value="0" required>
                                        <div class="input-group-append"><span class="input-group-text">%</span></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label>Product Image (optional)</label>
                                    <div class="input-group m-b-10">
                                        <div class="input-group-prepend"><span class="input-group-text">`</span></div>
                                        <input class="form-control" name=prodimg type="file">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Starting Inventory</label>
                                    <div class="input-group m-b-10">
                                        <div class="input-group-prepend"><span class="input-group-text">*</span></div>
                                        <input type="number" placeholder="0" name="inv_qty" class="form-control" required>
                                        <div class="input-group-append"><span class="input-group-text">#</span></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Inventory Critical Level</label>
                                    <div class="input-group m-b-10">
                                        <div class="input-group-prepend"><span class="input-group-text">*</span></div>
                                        <input type="number" placeholder="0" name="inv_critical" class="form-control" required>
                                        <div class="input-group-append"><span class="input-group-text">#</span></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label>Product Description</label>
                                        <textarea class="form-control" name=proddesc style="resize:vertical; width:100%;height:107px" placeholder="Product Description" required></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label>Product Note</label>
                                        <textarea class="form-control ckeditor" id="editor1"  name=prodnote style="resize:vertical; width:100%;height:107px" placeholder="Product Note"></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="span2"></div>
                                <input type="submit" class="btn btn-primary clearfix pull-right">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end panel-body -->
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-10 -->
    </div>
    <!-- end row -->
@endsection

@section('extrajs')

    <script>

        $('select').select2();
        @if(strtolower(\Illuminate\Support\Facades\Auth::user()->role)=='admin')
        $('select[name=affiliate]').on('change',function(){
                $('input[name="prodcode"]').val('{{date('Y')}}-'+$('select[name=affiliate] option:selected').text().substring(0,3).toUpperCase()+'-'+padDigits($(this).val(),5)+'-{{DB::Table('r_product_infos')
            ->get()->count()+1}}');
        });
        @else
        $('input[name=prodname]').on('keyup',function(){
            $('input[name="prodcode"]').val('{{date('Y')}}-'+'{{\App\r_affiliate_info::where('AFF_ID',Auth::user()->AFF_ID)->first()->AFF_NAME}}'.substring(0,3).toUpperCase()+'-'+padDigits({{Auth::user()->AFF_ID}},5)+'-{{DB::Table('r_product_infos')
            ->get()->count()+1}}');
        });
        @endif

        $('#data-table-buttons').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            "aaSorting": [[ 2, "desc" ]]
            ,dom: 'lBfrtip'
            ,   buttons: [
                { extend: 'copy', className: 'btn-sm',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                },
                { extend: 'csv', className: 'btn-sm' ,
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                },
                { extend: 'excel', className: 'btn-sm',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                },
                { extend: 'pdf', className: 'btn-sm',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                },
                { extend: 'print', className: 'btn-sm',
                    exportOptions: {
                        columns: [0,1,2,3,4]
                    }
                },


            ],
        });
    </script>
@endsection
