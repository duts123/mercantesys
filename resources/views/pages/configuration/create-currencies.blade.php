@extends('layouts.main')

@section('title','Currencies Create')

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Currencies</a></li>
        <li class="breadcrumb-item active">create</li>
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

                        <a class="btn btn-xs btn-success" href="{{action('manageCurrency@index')}}"><i class="fa fa-list"></i> List </a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                    <h4 class="panel-title">Create Currencies</h4>
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
                    <div class="panel-body panel-form">
                        <form method="post" id="currency" action="{{url('currency')}}"  enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="POST" />
                            <div class="row">

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
