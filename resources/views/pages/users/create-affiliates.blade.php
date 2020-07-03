@extends('layouts.main')

@section('title','Create Affiliate`s Profile')

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Users Managemet</a></li>
        <li class="breadcrumb-item active">List</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Manage Affiliate <small>...</small></h1>
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

                        <a class="btn btn-xs btn-success" href="{{action('manageAffiliates@index')}}"><i class="fa fa-list"></i> List </a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                    <h4 class="panel-title">Create Users</h4>
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
                        <form method="post" id="taxModal" action="{{action('manageAffiliates@store')}}"  enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="POST" />
                            <div class="row">

                                    <div class="col-md-6">
                                        <label>Name</label>
                                        <div class="input-group m-b-10">
                                            <div class="input-group-prepend"><span class="input-group-text">*</span></div>
                                            <input class="form-control" name=affname placeholder="Name" required onkeyup="$('input[name=code]').val(($(this).val())?$(this).val().substring(0,3).toUpperCase()+'-'+'{{date('Y')}}'+'-'+'{{DB::Table('users')->get()->count()+1}}':'')">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Code</label>
                                        <div class="input-group m-b-10">
                                            <div class="input-group-prepend"><span class="input-group-text">*</span></div>
                                            <input class="form-control" name=code type="text" placeholder="Code" required>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Payment Mode</label>
                                            <textarea class="form-control" name=paymentmode style="resize:vertical; width:100%;height:107px" placeholder="Description" required></textarea>

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Payment Instruction (how affiliate receives payments from sympies)</label>
                                            <textarea class="form-control" name=paymentinst style="resize:vertical; width:100%;height:107px" placeholder="Payment Instruction" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" name=desc style="resize:vertical; width:100%;height:107px" placeholder="Affiliate Description" required></textarea>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                    <div class="col-md-12" >
                                        <div class="pull-right" style="margin-right: 10px;">
                                            <button class="btn btn-success" type="submit" >Submit</button>
                                        </div>
                                    </div>
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
    </script>
@endsection
