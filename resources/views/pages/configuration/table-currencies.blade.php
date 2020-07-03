@extends('layouts.main')

@section('title','Currencies')

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Currencies</a></li>
        <li class="breadcrumb-item active">List</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Manage Currencies <small>...</small></h1>
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

                        <a href="{{action('manageCurrency@create')}}" class="btn btn-xs btn-success"><i class="fa fa-plus-square"></i> Add item </a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                    <h4 class="panel-title">Manage Currencies</h4>
                </div>
                <!-- end panel-heading -->
                <div class="panel-body bg-black text-white">
                    <div class="row">
                        <div class="col-md-12" >Base currency for conversion </div>
                        <div class="col-md-6">
                            <span style="font-weight: bolder;font-size: 3em;text-align: justify;">United States of America</span>
                        </div>
                        <div class="col-md-6">
                            <span style="font-weight: bolder;font-size: 3em;text-align: justify;">$ 51.02 dollar</span>
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
                    <table id="data-table-buttons" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 30%">Info</th>
                            <th>Rate</th>
                            <th>Tax</th>
                            <th>Date Issued</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($curr as $item)
                            <tr>
                                <td><strong>{{ $item->CURR_COUNTRY }} ({{$item->CURR_ACR}})</strong>
                                    <br><small>{{ $item->CURR_SYMBOL }} - {{ $item->CURR_NAME }} </small></td>
                                <td>{{$item->CURR_RATE}}</td>
                                <td>{{ $item->rTaxTableProfile->TAXP_NAME  }} - {{ $item->rTaxTableProfile->TAXP_RATE  }}</td>
                                <td>{{ (new DateTime($item->created_at))->format('D M d, Y | h:i A') }}</td>
                                <td>
                                    <center>
                                        <a title="Edit" class="btn btn-info" id='edit' data-toggle="modal" data-value="{{$item->CURR_ID}}" href="#editSetup"><i class="fas fa-pencil-alt text-white"></i></a>
                                    </center>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <th style="width: 30%">Info</th>
                            <th>Rate</th>
                            <th>Tax</th>
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
    <div class="modal modal-message fade" id="editSetup" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Currency</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <form method="post" id="setupModal" action="{{url('currency')}}"  enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="PATCH" />
                        <div class="row">
                            <div class="col-md-12" style="padding-bottom: 20px;">
                                <strong>Are you sure? you want to edit this record?</strong>
                                <p>Please provide the following inputs to validate the record.</p>
                            </div>

                            <div class="col-md-6">
                                <label>Country</label>
                                <div class="input-group m-b-10">
                                    <div class="input-group-prepend"><span class="input-group-text">*</span></div>
                                    <input class="form-control" name=country placeholder="Philippines" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Acronym</label>
                                <div class="input-group m-b-10">
                                    <div class="input-group-prepend"><span class="input-group-text">*</span></div>
                                    <input class="form-control" name=acronym type="text" placeholder="PHP" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Symbol</label>
                                <div class="input-group m-b-10">
                                    <div class="input-group-prepend"><span class="input-group-text">*</span></div>
                                    <input class="form-control" name=symbol type="text" placeholder="₱" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label>Currency Name</label>
                                <div class="input-group m-b-10">
                                    <div class="input-group-prepend"><span class="input-group-text">*</span></div>
                                    <input class="form-control" name=name type="text" placeholder="Peso" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label>Currency Rate</label>
                                <div class="input-group m-b-10">
                                    <div class="input-group-prepend"><span class="input-group-text">*</span></div>
                                    <input class="form-control" name=rate type="text" placeholder="Rate" required>
                                    <div class="input-group-append"><span class="input-group-text">#</span></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Product Tax</label>
                                    <select class="form-control productType" name="tax" style="width: 100%;" required >
                                        <option selected value="0" disabled>Please Select Tax Reference</option>
                                        <optgroup label="Percentage">
                                            @foreach($taxProf->where('TAXP_TYPE',0) as $item)
                                                <option value="{{$item->TAXP_ID}}">{{$item->TAXP_NAME}} - {{$item->TAXP_RATE}} % </option>
                                            @endforeach
                                        </optgroup>
                                        <optgroup label="Fixed">
                                            @foreach($taxProf->where('TAXP_TYPE',1) as $item)
                                                <option value="{{$item->TAXP_ID}}">{{$item->TAXP_NAME}} - {{$item->TAXP_RATE}}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="col-md-12" >
                            <div class="pull-right" style="margin-right: 10px;">
                                <button class="btn btn-success" type="submit" >Submit</button>
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

        $('select').select2({ dropdownParent: $('#editSetup')});

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


        $('a[id=edit]').on('click',function(){
            $id = $(this).attr('data-value');

            $.ajax({
                type:'get'
                ,url: '/currency/'+$id
                ,dataType:'json'
                ,data: {_token:CSRF_TOKEN }
                ,success: function($data){

                    $('input[name=name]').val($data.data[0].CURR_NAME);
                    $('input[name=country]').val($data.data[0].CURR_COUNTRY);
                    $('input[name=acronym]').val($data.data[0].CURR_ACR);
                    $('input[name=symbol]').val($data.data[0].CURR_SYMBOL);
                    $('input[name=rate]').val($data.data[0].CURR_RATE);
                    $('select[name=tax]').val($data.data[0].TAXP_ID).trigger('change');
                    $('#setupModal').attr('action','{{url('currency')}}/'+$data.data[0].CURR_ID);
                }
                ,error: function(){

                }
            });

        });


    </script>
@endsection
