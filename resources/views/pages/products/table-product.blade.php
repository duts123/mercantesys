@extends('layouts.main')

@section('title','Product List')

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Manage Products</a></li>
        <li class="breadcrumb-item active">List</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Manage Products <small>products provided by different affiliates...</small></h1>
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

                        <a href="{{action('manageProduct@create')}}" class="btn btn-xs btn-success"><i class="fa fa-plus-square"></i> Add item </a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                    <h4 class="panel-title">Manage Products</h4>
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
                    <table id="data-table-buttons" class="table  table-bordered">
                        <thead>
                        <tr>
                            <th width="30%">Product Info</th>
                            <th>Base | Selling Price </th>
                            <th>Status</th>
                            <th>Affiliate</th>
                            <th>Date Modified</th>
                            <th width="15%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($prodInfo as $item)
                            <tr style="background-color: {{($item->PROD_IS_APPROVED==0 || $item->PROD_DISPLAY_STATUS == 0)?'#fdeeee':'#eefdee'}}">
                                <td>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <center>
                                                <a href="{{($item->PROD_IMG==null||!file_exists($item->PROD_IMG))?asset('uPackage.png'):asset($item->PROD_IMG)}}" data-lightbox="gallery-group-1">
                                                    <img style="width: 50%;height: 100%;" src="{{($item->PROD_IMG==null||!file_exists($item->PROD_IMG))?asset('uPackage.png'):asset($item->PROD_IMG)}}">
                                                </a>
                                            </center>
                                           <br>
                                        </div>
                                        <div class="col-md-8">
                                            <strong style="color:dimgray">{{$item->PROD_CODE}}</strong><br>
                                            <strong>{{ $item->PROD_NAME}}</strong><br>
                                            <small>{{ $item->PROD_DESC}}</small><br>
                                        </div>
                                    </div>
                                </td>
                                <td>

                                    Base Price: {{number_format($item->PROD_BASE_PRICE,2)}} <br>
                                    Discount (%): {{$discount=$item->PROD_DISCOUNT}}% <br>
                                    Selling Price:
                                    @php

                                        $woDtotal= $item->PROD_MY_PRICE;

                                        echo $total = ($woDtotal!='NAN')?number_format(($discount)?$woDtotal-($woDtotal*($discount/100)):$woDtotal,2):$woDtotal
                                    @endphp
                                </td>
                                <td data-toggle="tooltip" title="{{$item->PROD_AVAILABILITY}}">
                                    @if(\App\Providers\sympiesProvider::isAvailable($item->PROD_AVAILABILITY))
                                        <label style="color:green">Available</label>
                                    @else
                                        <label style="color:red">Not Available</label>
                                    @endif
                                </td>
                                <td data-toggle="tooltip" title ="{{$item->rAffiliateInfo->AFF_NAME}}"  data-order="{{$item->rAffiliateInfo->AFF_NAME}}" data-title="{{$item->rAffiliateInfo->AFF_NAME}}">
                                    <center>
                                        <img src="{{ Avatar::create($item->rAffiliateInfo->AFF_NAME)->toBase64() }}" style="height: 40px;">

                                        <br><span style="color: gray;">{{$item->rAffiliateInfo->AFF_NAME}}</span>
                                    </center>
                                </td>
                                    <td data-order="{{$item->created_at}}">{{ (new DateTime($item->created_at))->format('D M d, Y | h:i A') }}</td>

                                <td>
                                    <center>

                                        {{--{{ ($item->PROD_APPROVED_AT=='')?'':(new DateTime($item->PROD_APPROVED_AT))->format('D M d, Y | h:i A') }}--}}
                                        <div class="btn-group">
                                            @if($item->PROD_DISPLAY_STATUS==1)
                                                @if(Auth::user()->role=='admin')
                                                    @if(is_null($item->PROD_IS_APPROVED))
                                                        {{--<a href="#approve" data-toggle="modal" class="btn btn-success" id="app" vals="{{$item->PROD_ID}}" onclick="$('span[id=BasePrice]').text('{{$item->PROD_BASE_PRICE}}');$('input[id=prodmyprice]').val('{{$item->PROD_MY_PRICE}}')"><i class="fa fa-thumbs-up"></i></a>--}}
                                                        <a href="#disapprove" data-toggle="modal" class="btn btn-danger" id="disap" vals="{{$item->PROD_ID}}" ><i class="fa fa-thumbs-down"></i></a>
                                                    @elseif($item->PROD_IS_APPROVED==0)
                                                        <a href="#approve" data-toggle="modal" class="btn btn-success" id="app"  vals="{{$item->PROD_ID}}"><i class="fa fa-thumbs-up"></i></a>
                                                    @elseif($item->PROD_IS_APPROVED==1)
                                                        <a href="#disapprove" data-toggle="modal"  class="btn btn-danger" id="disap" vals="{{$item->PROD_ID}}"><i class="fa fa-thumbs-down"></i></a>
                                                    @endif
                                                @endif
                                                <button type="button" class="btn btn-info btn-flat dropdown-toggle" data-toggle="dropdown">More</button>
                                                <ul class="dropdown-menu" role="menu">
                                                        <li> <a  id='viewProduct' total="{{$total}}" href="#prodView" data-toggle="modal" vals="{{$item->PROD_ID}}" >View</a></li>
                                                        <li> <a  id='editProduct' href="{{action('manageProduct@edit',$item->PROD_ID)}}" >Edit Product Info</a></li>
                                                        <li> <a  id='editVariance' href="#productVariance" data-toggle="modal" vals="{{$item->PROD_ID}}" onclick="$('input[id=varProdID]').val({{$item->PROD_ID}}); $('input[id=varProdCODE]').val('{{$item->PROD_CODE}}');" prod-name="{{$item->PROD_NAME}}" prod-desc="{{$item->PROD_DESC}}" >Product Variance</a></li>
                                                        <li> <a  id='discount' href="#adddiscount" data-toggle="modal" vals="{{$item->PROD_ID}}"  woDtotal ='{{$woDtotal}}' discount="{{$item->PROD_DISCOUNT}}" onclick="$('input[id=DiscountProdID]').val({{$item->PROD_ID}});">Configure Discount</a></li>
                                                        <li class="divider"></li>
                                                        <li> <a  id=deact href="#"  vals="{{$item->PROD_ID}}"  >Deactivate</a></li>
                                                </ul>
                                            @else
                                                <a id=act  vals="{{$item->PROD_ID}}" class="btn btn-success"><i class="fas fa-undo text-white"></i></a>
                                            @endif
                                        </div>
                                    </center>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <th width="30%">Product Info</th>
                            <th>Base | Selling Price</th>
                            <th>Status</th>
                            <th>Affiliate</th>
                            <th>Date Modified</th>
                            <th width="15%">Action</th>
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



    <div class="modal modal-message fade" id="approve" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">You are about to approve the product to be posted into the shop</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <form id="approvalForm" method="post" action="{{url('/product/appDisapprove')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input name="type" value="1" style="display: none;">
                        <input id="prodID" name="id" value="1" style="display: none;">
                        <input type="hidden" name="_method" value="POST" />
                        <div class="row" style="padding: 10px;">
                            <div class="col-md-12" style="padding-bottom: 20px;">
                                <strong>Are you sure? you want to approved this product?</strong>
                                <p>Please provide the following inputs to validate the product in the market.</p>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label>My Price in Percentage (Sympies)</label>
                                    <div class="input-group">
                                        <input type="number" placeholder="0" id="percentage" class="form-control" required>
                                        <div class="input-group-addon">
                                           %
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6" style=""><label>Base Price (Affiliate)</label>
                                <div class="col-md-12" style="background: lightgray;">
                                    <span id="BasePrice" style="color: gray;font-weight: bolder;font-size: 5em;text-align: justify;"></span>
                                </div>
                            </div>
                            <div class="col-md-6" style=""><label>Total My Price (Sympies)</label>
                                <div class="col-md-12" style="background: salmon;">
                                    <input name="prodmyprice" style="display: none;">
                                    <span id="myprice" style="color: white;font-weight: bolder;font-size: 5em;text-align: justify;"></span>
                                </div>
                            </div>


                            <div class="pull-right" style="margin-right: 10px;">
                                <br>
                                <button type="submit" class="btn btn-success">Save changes</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-message fade" id="adddiscount" >
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Configure Discount</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form id="prodDiscountForm" method="post" action="{{url('product/discount')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input id="DiscountProdID" name="prodID" value="0" style="display: none;">
                        <div class="row">
                            <div class="col-md-12" style="padding-bottom: 20px;">
                                <strong>Are you sure? you wan to set discount for this product?</strong>
                                <p>Please provide the following inputs to validate the product in the market.</p>
                            </div>
                            <div class="col-md-6" style="background: lightgray;">
                                <span id="SellingPrice" style="color: gray;font-weight: bolder;font-size: 5em;text-align: justify;"></span>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Discount(Percentage)</label>
                                    <div class="input-group">
                                        <input type="number" placeholder="0" name="prodDiscount" min="0" max="100" class="form-control" required>
                                        <div class="input-group-addon">
                                            %
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pull-right" style="margin-right: 10px;">
                                <br>
                                <button type="submit" class="btn btn-success" id="appSave">Save changes</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-message fade" id="productVariance" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="margin-left: 0;width: 100%;">
                    <h4 class="modal-title">You are about to add product variance</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" style="margin-left: 0;width: 100%;">
                    <form id="productVarianceForm" method="post" action="{{url('/product/ProductVar')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input id="varProdID" name="prodID" value="1" style="display: none;">
                        <input id="varProdCODE" name="prodCODE" value="1" style="display: none;">
                        <div class="row" style="padding: 10px;">
                            <div class="col-md-12" style="padding-bottom: 20px;">
                                <strong id="prodname">Product Name</strong>
                                <p id="proddesc">Product Description</p>
                            </div>
                            <table id="prodvartable" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>SKU</th>
                                    <th>Name*</th>
                                    <th width="10%">Additional Price*</th>
                                    <th width="20%">Image (optional)</th>
                                    <th>Description*</th>
                                    <th width="10%">Stock Qty*</th>
                                    <th><a id=addVar class="btn btn-success"><i class="fa fa-plus text-white"></i></a></th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>SKU</th>
                                    <th>Name</th>
                                    <th>Additional Price</th>
                                    <th>Image (optional)</th>
                                    <th>Description</th>
                                    <th>Stock Qty</th>
                                    <th><a id=clearAllVar class="btn btn-danger"><i class="fa fa-ban text-white"></i></a></th>
                                </tr>
                                </tfoot>
                            </table>


                            <div class="pull-right" style="margin-right: 10px;">
                                <br>
                                <button type="submit" class="btn btn-success" id="appSave">Save changes</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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


        $('a[id=discount]').on('click',function(){
           $woDtotal = parseFloat($(this).attr('woDtotal'));
           $discount = parseFloat($(this).attr('discount'));
           $('span[id=SellingPrice]').text(moneyFormat($woDtotal.toFixed(2)));
           $('input[name=prodDiscount]').trigger('keyup').val($discount);
           $('span[id=SellingPrice]').text(moneyFormat($woDtotal-($woDtotal*($discount/100)).toFixed(2)));

           $('input[name=prodDiscount]').on('keyup paste change',function(){
               $('span[id=SellingPrice]').text(moneyFormat($woDtotal-($woDtotal*($(this).val()/100)).toFixed(2)));
           });


        });
        $('select[name=prodtax]').select2({ dropdownParent: $('#approve')});

        $("a[id='app']").on('click',function(){
            $id =$(this).attr('vals');
            $('#approvalForm #prodID').val($(this).attr('vals'));
            $("select[name='prodtax']").val(0).trigger('change');
            $("input[name='prodrebate']").val(null);
            $("input[name='prodmarkup']").val(null);
            $.ajax({
                url: '/product/list/'+$id
                ,type: 'get'
                ,data: {_token:CSRF_TOKEN }
                ,dataType:'json'
                ,success:function($data){
                    $("input[name='prodrebate']").val($data.data[0].PROD_REBATE);
                    $("select[name='prodtax']").val($data.data[0].TAXP_ID).trigger('change');
                    $("input[name='prodmarkup']").val($data.data[0].PROD_MARKUP);
                }
                ,error:function(){

                }
            });
        });
        $("#addVar").on("click",function(){
            $(this).closest('table').find('tbody').append(
                '   <tr>\n' +
                '            <td style="display:none"><input  name="prodVarID[]" value="0" class="hidden"></td>\n' +
                '            <td><input id=SKU name=SKU[] readonly class="form-control"  value="'+$('input[id=varProdCODE]').val()+'"></td>\n' +
                '            <td><input id=prodvarname type="text" placeholder="Product Variance Name" name="prodvarname[]" class="form-control" required></td>\n' +
                '            <td><div class="input-group">\n' +
                '                <input type="number" placeholder="0" name="addprice[]" value=0 class="form-control" required>\n' +
                '            <div class="input-group-addon">\n' +
                '                #\n' +
                '                </div>\n' +
                '                </div>\n' +
                '                </td>\n' +
                '                <td><input class="form-control" name=prodvarimg[] type="file" accept="image/*"></td>\n' +
                '                <td><textarea class="form-control" name=prodvardesc[] style="resize:vertical; width:100%;height:36px" placeholder="Product Description" required></textarea></td>\n' +
                '            <td><div class="input-group">\n' +
                '                <input type="number" placeholder="0" name="inv_qty[]" class="form-control" required>\n' +
                '            <div class="input-group-addon">\n' +
                '                #\n' +
                '                </div>\n' +
                '                </div>\n' +
                '                </td>\n' +
                '            <td><a class="btn btn-danger" onclick="if($(\'#prodvartable tbody tr\').length>1)$(this).closest(\'tr\').remove()"><i class="fa fa-minus text-white"></i></a></td>\n' +
                '   </tr>'
            );
        });


        $("#clearAllVar").on('click',function(){
            $id = $("input[id=varProdID]").val();
            $.ajax({
                url: '/product/deleteAllProductVar'
                ,type: 'post'
                ,data: {_token:CSRF_TOKEN,id:$id }
                ,dataType:'json'
                ,success:function($data) {
                    window.location.reload();
                }
                ,error:function(){}
            });

        });
        $("a[id='editVariance']").on('click',function() {
            $('input[name=prodID]').val($(this).attr('vals'));
            $id = $(this).attr('vals');
            $("#productVariance #prodname").html($(this).attr('prod-name'));
            $("#productVariance #proddesc").html($(this).attr('prod-desc'));
            $.ajax({
                url: '/product/showProductVar/'+$id
                ,type: 'get'
                ,data: {_token:CSRF_TOKEN }
                ,dataType:'json'
                ,success:function($data){
                    $('#prodvartable').find('tbody tr').remove();
                    $.each($data.data,function(index,value){
                        $('#prodvartable').find('tbody').append(
                            '   <tr>\n' +
                            '            <td style="display:none"><input  name="prodVarID[]" value="'+$data.data[index].PRODV_ID+'" class="hidden"></td>\n>?' +
                            '            <td><input existing =true id=SKU name=SKU[] readonly class="form-control"  value="'+$data.data[index].PRODV_SKU+'"></td>\n' +
                            '            <td><input id=prodvarname value="'+$data.data[index].PRODV_NAME+'" type="text" placeholder="Product Variance Name" name="prodvarname[]" class="form-control" required></td>\n' +
                            '            <td><div class="input-group">\n' +
                            '                <input value="'+$data.data[index].PRODV_ADD_PRICE+'"  type="number" placeholder="0" name="addprice[]" class="form-control" required >\n' +
                            '            <div class="input-group-addon">\n' +
                            '                #\n' +
                            '                </div>\n' +
                            '                </div>\n' +
                            '                </td>\n' +
                            '                <td><input  class="form-control" name=prodvarimg[] type="file" accept="image/*"></td>\n' +
                            '                <td><textarea class="form-control" name=prodvardesc[] style="resize:vertical; width:100%;height:36px" placeholder="Product Description" required>'+$data.data[index].PRODV_DESC+'</textarea></td>\n' +
                            '            <td><div class="input-group">\n' +
                            '                <input type="number" placeholder="0" name="inv_qty[]" readonly value='+$data.data[index].PRODV_INIT_QTY+' class="form-control" required>\n' +
                            '            <div class="input-group-addon">\n' +
                            '                #\n' +
                            '                </div>\n' +
                            '                </div>\n' +
                            '                </td>\n' +
                            '            <td><a class="btn btn-danger" onclick="if($(\'#prodvartable tbody tr\').length>1)$(this).closest(\'tr\').remove()"><i class="fa fa-minus text-white"></i></a></td>\n' +
                            '            </tr>'
                        );

                    });

                    $('#prodvartable').find('tbody').append(
                        '   <tr>\n' +
                        '            <td style="display:none"><input  name="prodVarID[]" value="0" class="hidden"></td>\n' +
                        '            <td><input id=SKU name=SKU[] readonly class="form-control"  value="'+$('input[id=varProdCODE]').val()+'"></td>\n' +
                        '            <td><input id=prodvarname type="text" placeholder="Product Variance Name" name="prodvarname[]" class="form-control" required></td>\n' +
                        '            <td><div class="input-group">\n' +
                        '                <input type="number" placeholder="0" name="addprice[]" class="form-control" required value=0>\n' +
                        '            <div class="input-group-addon">\n' +
                        '                #\n' +
                        '                </div>\n' +
                        '                </div>\n' +
                        '                </td>\n' +
                        '                <td><input class="form-control" name=prodvarimg[] type="file" accept="image/*"></td>\n' +
                        '                <td><textarea class="form-control" name=prodvardesc[] style="resize:vertical; width:100%;height:36px" placeholder="Product Description" required></textarea></td>\n' +
                        '            <td><div class="input-group">\n' +
                        '                <input type="number" placeholder="0" name="inv_qty[]" class="form-control" required>\n' +
                        '            <div class="input-group-addon">\n' +
                        '                #\n' +
                        '                </div>\n' +
                        '                </div>\n' +
                        '                </td>\n' +
                        '            <td><a class="btn btn-danger" onclick="if($(\'#prodvartable tbody tr\').length>1)$(this).closest(\'tr\').remove()"><i class="fa fa-minus text-white"></i></a></td>\n' +
                        '   </tr>'
                    );

                }
                ,error:function(){}
            });

        });


        $('table[id="prodvartable"]').on('keyup paste','input[id=prodvarname]',function(){
            if(!$(this).closest('td').closest('tr').find('input[name="SKU[]"]').attr('existing'))
           $(this).closest('td').closest('tr').find('input[name="SKU[]"]').val($('input[id=varProdCODE]').val()+'-'+$(this).val().substring(0,3).toUpperCase()+Math.random().toString(36).replace('0.', '').substring(0,3));
        });
        $('#data-table-buttons').DataTable({
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            "aaSorting": [[ 4, "desc" ]]
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


        $("a[id='disap']").on('click',function(){
            $id = $(this).attr('vals');
            swal({
                title: "This product will be disapproved?"
                , text: "After this action, this product is not available on market, unless it is activated"
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
                        url: '/product/appDisapprove'
                        ,type: 'post'
                        ,data: {id:$id,_token:CSRF_TOKEN, type:0  }
                        ,success:function(){
                            window.location.reload();
                        }
                        ,error:function(){}
                    });
                }
            });
        });

        $("a[id='app']").on('click',function(){
            $id =$(this).attr('vals');
            $('#approvalForm #prodID').val($(this).attr('vals'));
            $("input[name='prodmyprice']").val(null);
            $("span[id='BasePrice']").text(null);
            $.ajax({
                url: '/product/list/'+$id
                ,type: 'get'
                ,data: {_token:CSRF_TOKEN }
                ,dataType:'json'
                ,success:function($data){
                    $("input[name='prodmyprice']").val($data.data[0].PROD_MY_PRICE);
                    $('span[id=myprice]').text($data.data[0].PROD_MY_PRICE);
                    $("span[id='BasePrice']").text($data.data[0].PROD_BASE_PRICE);
                }
                ,error:function(){

                }
            });
        });

        $('input[id=percentage]').on('keyup',function () {
            $total = parseFloat($("span[id='BasePrice']").text());
            $comp = ($total)+($total * ($(this).val() / 100));
           $('input[name=prodmyprice]').val($comp);
           $('span[id=myprice]').text($comp);
        });
        $("a[id='deact']").on('click',function(){
            $id = $(this).attr('vals');
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
                        url: '/product/actDeact'
                        , type: 'post'
                        , data: {id: $id, _token: CSRF_TOKEN, type: 0}
                        , success: function () {
                            location.reload();
                        }
                        , error: function () {

                        }
                    });
                }
            });
        });

        $("a[id='act']").on('click',function(){
            $id = $(this).attr('vals');
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
                        url: '/product/actDeact'
                        , type: 'post'
                        , data: {id: $id, _token: CSRF_TOKEN, type: 1}
                        , success: function () {
                            location.reload();
                        }
                        , error: function () {

                        }
                    });
                }
            });
        });



        $("a[id=discount]").on('click',function(){


        });
    </script>
@endsection
