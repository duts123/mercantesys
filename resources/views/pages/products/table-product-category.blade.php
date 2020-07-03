@extends('layouts.main')

@section('title','Product Category')

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Manage Product Categories</a></li>
        <li class="breadcrumb-item active">List</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Manage Product Categories<small> products provided by different affiliates...</small></h1>
    <!-- end page-header -->

    <!-- begin row -->
    <div class="row">
        <div class="col-md-12">

            @if(session('success') || session('error') )
                <div class="alert alert-{{(session('success')?'success':'danger')}} fade show">
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{(session('success'))?session('success'):session('error')}}
                </div>
            @endif
        </div>
        <!-- begin col-10 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <div class="panel-heading-btn">

                        <a href="{{url('/product/category/create/0')}}" class="btn btn-xs btn-success"><i class="fa fa-plus-square"></i> Add item </a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                    <h4 class="panel-title">Manage Product Categories</h4>
                </div>
                <!-- end panel-heading -->

                <div class="panel-body bg-black text-white">...</div>
                <!-- end alert -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <table id="data-table-buttons" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 30%">Info</th>
                            <th>Sub-Categories</th>
                            <th>Date Issued</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cat->where('PRODT_PARENT',null) as $item)
                            <tr>
                                {{--<td>{{ $affInfo->where('AFF_ID', $item->AFF_ID)->first()->AFF_NAME }}</td>--}}
                                <td><strong>{{ $item->PRODT_TITLE }}</strong><br><small>{{ $item->PRODT_DESC }}</small></td>
                                <td><center>
                                        @foreach($cat->where('PRODT_PARENT',$item->PRODT_ID) as $sub)
                                            @if($sub->PRODT_DISPLAY_STATUS==1)
                                                <span class="label label-primary">{{$sub->PRODT_TITLE}}</span>
                                            @else
                                                <span class="label label-danger">{{$sub->PRODT_TITLE}}</span>
                                            @endif
                                        @endforeach
                                    </center>
                                </td>
                                <td>{{ (new DateTime($item->updated_at))->format('D M d, Y | h:i A') }}</td>
                                <td>
                                    <center>
                                        @if($item->PRODT_DISPLAY_STATUS==1)
                                                <a class="btn btn-info" id='editCat'data-toggle="modal" vals="{{$item->PRODT_ID}}" href="#prodcatsetup"><i class="fas fa-pencil-alt text-white"></i></a>
                                            <a id=deact  vals="{{$item->PRODT_ID}}" class="btn btn-danger" data-toggle="modal" data-target="#deactivate"><i class="fa fa-ban text-white"></i></a>
                                        @else
                                            <a id=act  vals="{{$item->PRODT_ID}}" class="btn btn-success" data-toggle="modal" data-target="#activate"><i class="fas fa-undo text-white"></i></a>
                                        @endif
                                    </center>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <th style="width: 30%">Info</th>
                        <th>Sub-Categories</th>
                        <th>Date Issued</th>
                        <th>Action</th>
                        </tfoot>
                    </table>
                </div>
                <!-- end panel-body -->
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-10 -->

        <!-- begin col-10 -->
        <div class="col-lg-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <div class="panel-heading-btn">

                        <a href="{{url('/product/category/create/1')}}" class="btn btn-xs btn-success"><i class="fa fa-plus-square"></i> Add item </a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                    <h4 class="panel-title">Manage Product Sub-Categories</h4>
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <table id="data-table-buttons" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 30%">Info</th>
                            <th>Parent Category</th>
                            <th>Date Issued</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cat->where('PRODT_PARENT','!=',null) as $item)
                            <tr>
                                {{--<td>{{ $affInfo->where('AFF_ID', $item->AFF_ID)->first()->AFF_NAME }}</td>--}}
                                <td><strong>{{ $item->PRODT_TITLE }}</strong><br><small>{{ $item->PRODT_DESC }}</small></td>
                                <td>
                                    <center>
                                        @if($item->rProductType->PRODT_DISPLAY_STATUS==1)
                                            <span class="label label-success">{{$item->rProductType->PRODT_TITLE}}</span>
                                        @else
                                            <span class="label label-danger">{{$item->rProductType->PRODT_TITLE}}</span>
                                        @endif
                                    </center>
                                </td>
                                <td>{{ (new DateTime($item->updated_at))->format('D M d, Y | h:i A') }}</td>
                                <td>
                                    <center>
                                        @if($item->PRODT_DISPLAY_STATUS==1)
                                            <a class="btn btn-info" id='editsubCat'data-toggle="modal" vals="{{$item->PRODT_ID}}" href="#prodsubcat"><i class="fas fa-pencil-alt text-white"></i></a>
                                            <a id=deact  vals="{{$item->PRODT_ID}}" class="btn btn-danger" data-toggle="modal" data-target="#deactivate"><i class="fa fa-ban text-white"></i></a>
                                        @else
                                            <a id=act  vals="{{$item->PRODT_ID}}" class="btn btn-success" data-toggle="modal" data-target="#activate"><i class="fas fa-undo text-white"></i></a>
                                        @endif
                                    </center>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <th style="width: 30%">Info</th>
                        <th>Parent Category</th>
                        <th>Date Issued</th>
                        <th>Action</th>
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



    <div class="modal modal-message fade" id="prodcatsetup" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Product Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <form method="post" id="prodtCatForm" action="{{url('product/category')}}"  enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="POST" />
                        <input style="display: none;" name="type" value="0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input class="form-control" name=prodttitle placeholder="Name" required>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" name=prodtdesc style="resize:vertical; width:100%;height:107px" placeholder="Description" required></textarea>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>
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


    <div class="modal modal-message fade" id="prodsubcat" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Product Sub-Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <form method="post" id="prodtSubCatForm" action="{{url('product/category')}}"  enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="POST" />
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input class="form-control" name=prodttitle placeholder="Name" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" name=prodtdesc style="resize:vertical; width:100%;height:107px" placeholder="Description" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Product Parent (optional)</label>
                                        <select class="form-control prodParent" name="prodparent" style="width: 100%;" required>
                                            @foreach($cat->where('PRODT_PARENT',null)->where('PRODT_DISPLAY_STATUS',1)   as $item)
                                                    <option value="{{$item->PRODT_ID}}">{{$item->PRODT_TITLE}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>
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



        $('select').select2({ dropdownParent: $('#prodsubcat')});

        $("a[id='addProduct']").on('click',function(){
            document.querySelector('#prodtCatForm').reset();
            document.querySelector('#prodtSubCatForm').reset();
            $("input[name='_method']").attr('value','POST');

        });
        $("a[id='editCat']").on('click',function () {
            document.querySelector('#prodtCatForm').reset();
            document.querySelector('#prodtSubCatForm').reset();
            $id = $(this).attr('vals');
            $.ajax({
                url: '/product/category/'+$id
                ,type: 'get'
                ,data: {_token:CSRF_TOKEN }
                ,dataType:'json'
                ,success:function($data){

                    $("input[name='prodttitle']").val($data.data[0].PRODT_TITLE);
                    $("textarea[name='prodtdesc']").val($data.data[0].PRODT_DESC);
                    $('form').attr('action','{{url('product/category')}}/'+$data.data[0].PRODT_ID);
                    $("input[name='_method']").attr('value','PATCH');
                }
                ,error:function(){

                }
            });

        });



        $("a[id='editsubCat']").on('click',function () {
            document.querySelector('#prodtCatForm').reset();
            document.querySelector('#prodtSubCatForm').reset();
            $id = $(this).attr('vals');
            $.ajax({
                url: '/product/category/'+$id
                ,type: 'get'
                ,data: {_token:CSRF_TOKEN }
                ,dataType:'json'
                ,success:function($data){

                    $("input[name='prodttitle']").val($data.data[0].PRODT_TITLE);
                    $("textarea[name='prodtdesc']").val($data.data[0].PRODT_DESC);
                    $("select[name='prodparent']").val($data.data[0].PRODT_PARENT).trigger('change');
                    $('form').attr('action','{{url('product/category')}}/'+$data.data[0].PRODT_ID);
                    $("input[name='_method']").attr('value','PATCH');
                }
                ,error:function(){

                }
            });

        });
        $('table[id=data-table-buttons]').DataTable({
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
                        columns: [0,1,2]
                    }
                },
                { extend: 'csv', className: 'btn-sm' ,
                    exportOptions: {
                        columns: [0,1,2]
                    }
                },
                { extend: 'excel', className: 'btn-sm',
                    exportOptions: {
                        columns: [0,1,2]
                    }
                },
                { extend: 'pdf', className: 'btn-sm',
                    exportOptions: {
                        columns: [0,1,2]
                    }
                },
                { extend: 'print', className: 'btn-sm',
                    exportOptions: {
                        columns: [0,1,2]
                    }
                },


            ],
        });


        $("a[id='addProduct']").on('click',function(){
            document.querySelector('#prodtCatForm').reset();
            document.querySelector('#prodtSubCatForm').reset();
            $("input[name='_method']").attr('value','POST');

        });
        $("a[id='editCat']").on('click',function () {
            document.querySelector('#prodtCatForm').reset();
            document.querySelector('#prodtSubCatForm').reset();
            $id = $(this).attr('vals');
            $.ajax({
                url: '/admin/shop/category/'+$id
                ,type: 'get'
                ,data: {_token:CSRF_TOKEN }
                ,dataType:'json'
                ,success:function($data){

                    $("input[name='prodttitle']").val($data.data[0].PRODT_TITLE);
                    $("textarea[name='prodtdesc']").val($data.data[0].PRODT_DESC);
                    $('form').attr('action','{{url('admin/shop/category')}}/'+$data.data[0].PRODT_ID);
                    $("input[name='_method']").attr('value','PATCH');
                }
                ,error:function(){

                }
            });

        });



        $("a[id='editsubCat']").on('click',function () {
            document.querySelector('#prodtCatForm').reset();
            document.querySelector('#prodtSubCatForm').reset();
            $id = $(this).attr('vals');
            $.ajax({
                url: '/admin/shop/category/'+$id
                ,type: 'get'
                ,data: {_token:CSRF_TOKEN }
                ,dataType:'json'
                ,success:function($data){

                    $("input[name='prodttitle']").val($data.data[0].PRODT_TITLE);
                    $("textarea[name='prodtdesc']").val($data.data[0].PRODT_DESC);
                    $("select[name='prodparent']").val($data.data[0].PRODT_PARENT).trigger('change');
                    $('form').attr('action','{{url('admin/shop/category')}}/'+$data.data[0].PRODT_ID);
                    $("input[name='_method']").attr('value','PATCH');
                }
                ,error:function(){

                }
            });

        });


        $("a[id='deact']").on('click',function(){
            $id = $(this).attr('vals');
            // $("button[id='deactSave']").on('click',function () {
            swal({
                title: "This record will be deactivated?"
                , text: "After this action, this record is not available, unless it is activated"
                , type: "warning"
                , showLoaderOnConfirm: true
                , showCancelButton: true
                , confirmButtonColor: '#9DD656'
                , confirmButtonText: 'Yes!'
                , cancelButtonText: "No!"
                , closeOnConfirm: false
                , closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        url: '/category/actDeact'
                        ,type: 'post'
                        ,data: {id:$id,_token:CSRF_TOKEN, type:0  }
                        ,success:function(){
                            window.location.reload();
                        }
                        ,error:function(){

                        }
                    });

                }
            });
            // });
        });

        $("a[id='act']").on('click',function(){
            $id = $(this).attr('vals');
            // $("button[id='actSave']").on('click',function () {

            swal({
                title: "This record will be activated?"
                , text: "After this action, this record is now available, unless it is deactivated"
                , type: "warning"
                , showLoaderOnConfirm: true
                , showCancelButton: true
                , confirmButtonColor: '#9DD656'
                , confirmButtonText: 'Yes!'
                , cancelButtonText: "No!"
                , closeOnConfirm: false
                , closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: '/category/actDeact'
                        ,type: 'post'
                        ,data: {id:$id,_token:CSRF_TOKEN, type:1  }
                        ,success:function(){
                            window.location.reload();
                        }
                        ,error:function(){

                        }
                    });
                }
            });

            // });
        });

    </script>
@endsection
