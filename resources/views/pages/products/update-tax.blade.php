@extends('layouts.main')

@section('title','Tax Profile Edit')

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Manage Product {{$type==1?'Sub-':''}}Category</a></li>
        <li class="breadcrumb-item active">update</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Create Product {{$type==1?'Sub-':''}}Category <small>products provided by different affiliates...</small></h1>
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

                        <a class="btn btn-xs btn-success" href="{{action('manageProductCategory@index')}}"><i class="fa fa-list"></i> List </a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                    <h4 class="panel-title">Create Product {{$type==1?'Sub-':''}}Category</h4>
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
                        <form class="form-horizontal form-bordered" method="post" action="{{ action('manageProductCategory@store')}}"  enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="POST" />
                            <input style="display: none;" name="type" value="{{$type}}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input class="form-control" name=prodttitle placeholder="Name" required>
                                    </div>
                                </div>
                                <br>
                                @if($type==1)
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Product Parent (optional)</label>
                                            <select class="form-control prodParent" name="prodparent" style="width: 100%;" >
                                                @foreach($cat->where('PRODT_PARENT',null)->where('PRODT_DISPLAY_STATUS',1)   as $item)
                                                    <option value="{{$item->PRODT_ID}}">{{$item->PRODT_TITLE}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                @endif


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control" name=prodtdesc style="resize:vertical; width:100%;height:107px" placeholder="Description" required></textarea>
                                    </div>
                                </div>


                            </div>
                            <!-- /.row -->
                            <br>
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
    </script>
@endsection
