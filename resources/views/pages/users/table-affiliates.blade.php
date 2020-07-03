@extends('layouts.main')

@section('title','Manage Affiliates')

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Affiliates Managemet</a></li>
        <li class="breadcrumb-item active">List</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Manage Affiliates <small>...</small></h1>
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

                        <a href="{{action('manageAffiliates@create')}}" class="btn btn-xs btn-success"><i class="fa fa-plus-square"></i> Add item </a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                    <h4 class="panel-title">Manage Affiliates</h4>
                </div>
                <!-- end panel-heading -->

                <div class="panel-body bg-black text-white">...</div>
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
                    <table id="data-table-buttons" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 30%">Info</th>
                            <th>Code</th>
                            <th>Payment Mode</th>
                            <th>Date Issued</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($aff as $item)
                            <tr>
                                <td><strong>{{ $item->AFF_NAME }}</strong><br><i>{{ $item->AFF_COD }}</i> </td>
                                <td>{{$item->AFF_CODE}}</td>
                                <td>{{ $item->AFF_PAYMENT_MODE   }}</td>
                                <td>{{ (new DateTime($item->created_at))->format('D M d, Y | h:i A') }}</td>
                                <td>
                                    <center>
                                        @if(!is_null($user->where('AFF_ID',$item->AFF_ID)->first()))
                                            <a class="btn btn-success"  data-toggle="modal" vals="{{$item->AFF_ID }}" href="#hasUser{{$item->AFF_ID }}" onclick="$('span[id=affiliatename]').text('{{$item->AFF_NAME}}')"><i class="fa fa-user"></i></a>

                                        @endif
                                        @if($item->AFF_DISPLAY_STATUS ==1)
                                            <a class="btn btn-info" href="{{action('manageAffiliates@edit',$item->AFF_ID)}}"><i class="fas fa-pencil-alt text-white"></i></a>
                                            <a id=deact  vals="{{$item->AFF_ID }}" class="btn btn-danger" data-toggle="modal" data-target="#deactivate"><i class="fa fa-ban text-white"></i></a>
                                        @else
                                            <a id=act  vals="{{$item->AFF_ID }}" class="btn btn-success" data-toggle="modal" data-target="#activate"><i class="fas fa-undo text-white"></i></a>
                                        @endif
                                    </center>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <th style="width: 30%">Info</th>
                        <th>Code</th>
                        <th>Payment Mode</th>
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
    @foreach($aff as $item)

        <div class="modal modal-message fade" id="hasUser{{$item->AFF_ID }}" >
            <div class="modal-dialog"  >
                <div class="modal-content">
                    <div class="modal-header" style="margin-left: 0;width: 100%;">
                        <h4 class="modal-title">User/s who can access the <span id="affiliatename"></span></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body" style="margin-left: 0;width: 100%;">
                        <div class="col-lg-12">
                            <table id="data-table-buttons" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 30%">Name</th>
                                    <th>Email</th>
                                    <th>Date Issued</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($user->where('AFF_ID',$item->AFF_ID) as $item1)
                                    <tr>
                                        <td><strong>{{ $item1->name }}</strong></td>
                                        <td>{{$item1->email}}</td>
                                        <td>{{ (new DateTime($item1->created_at))->format('D M d, Y | h:i A') }}</td>
                                        <td>{{ ($item1->USER_DisplayStat==0)?'Inactive':'Active'}}</td>

                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <th style="width: 30%">Name</th>
                                <th>Email</th>
                                <th>Date Issued</th>
                                <th>Status</th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div id="overlay" class="overlay" style="display:none">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>
            </div>
        </div>

    @endforeach


@endsection

@section('extrajs')

    <script>

        $('table[id=data-table-buttons]').DataTable({
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
                        columns: [0,1,2,3]
                    }
                },
                { extend: 'csv', className: 'btn-sm' ,
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                },
                { extend: 'excel', className: 'btn-sm',
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                },
                { extend: 'pdf', className: 'btn-sm',
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                },
                { extend: 'print', className: 'btn-sm',
                    exportOptions: {
                        columns: [0,1,2,3]
                    }
                },


            ],
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
                        url: '/affiliate/actDeact'
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
                        url: '/affiliate/actDeact'
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
