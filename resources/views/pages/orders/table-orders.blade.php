@extends('layouts.main')

@section('title','Manage Orders')

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Manage Orders</a></li>
        <li class="breadcrumb-item active">List</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Manage Orders <small>...</small></h1>
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

                        {{--<a href="{{action('manageTax@create')}}" class="btn btn-xs btn-success"><i class="fa fa-plus-square"></i> Add item </a>--}}
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                    <h4 class="panel-title">Manage Orders</h4>
                </div>
                <!-- end panel-heading -->

                <div class="panel-body bg-black text-white">
                    <a btn=1 id=shippedSome  vals="0" class="btn btn-primary" data-toggle="tooltip" title="Mark as Delivered" href="javascript:;">(<span id="countChecked">0</span>) <i class="fas fa-truck text-white"></i> Deliver Order</a>
                    <a btn=2 id=voidSome  vals="0" class="btn btn-danger" data-toggle="tooltip" title="Mark as Void" href="javascript:;">(<span id="countChecked">0</span>) <i class="fa fa-ban text-white"></i> Void Order</a>

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
                            <th style="width: 1%;" hidden>
                                <input type="checkbox" class="form-check-input" id="checkAll"  style="height: 20px;width: 20px;margin-top:20px;"/>
                            </th>
                            <th style="width: 40%" >Order Information</th>
                            <th style="width: 15%">Sender Info</th>
                            <th style="width: 15%">Receiver Info</th>
                            <th >Status</th>
                            <th >Date Issued</th>
                            <th >Action</th>
                        </thead>
                        <tbody>
                        @foreach($order as $item)
                            @php

                                $status = ucwords($item->ORD_STATUS);
                                $color = '';

                                if($status=='Completed') $color ='#cdfbcd';
                                elseif($status=='Pending') $color ='#ffe4b1';
                                elseif($status=='Request Refund') $color ='#ffe4b1';
                                elseif($status=='Request Cancellation') $color ='#ffe4b1';
                                elseif($status=='Cancelled') $color ='#ff8490';
                                elseif($status=='Void') $color ='#ff8490';
                                elseif($status=='Refunded') $color ='#ff8490';
                                elseif($status=='Approval Of Receipt') $color ='#ff8490';
                                else $color ='#cdfbcd';
                            @endphp
                            <tr>
                                <td hidden>
                                    <input vals="{{$item->ORD_ID}}" type="checkbox" class="form-check-input"  {{($status!='Completed' && $status!='Void')?'id=isChecked':'disabled=true'}}  style="height: 20px;width: 20px;margin-top:20px;"/>
                                </td>

                                <td>
                                    {{--<strong>Transaction Code: </strong>{{$item->ORD_TRANS_CODE}}<br>
                                    @foreach($order_item->where('ORD_ID',$item->ORD_ID) as $ord_item)
                                        Product Name: {{$ord_item->PROD_NAME}}<br>
                                        Qty: {{$ord_item->ORDI_QTY}}<br>
                                        Price: {{Sympies::current_price(number_format($ord_item->ORDI_SOLD_PRICE,2))}}
                                    @endforeach--}}
                                    
                                    <div class="row">
                                        <div class="col-md-4">
                                            <center>
                                                <a href="{{($item->ORD_PAYMENT_RECEIPT==null||!file_exists($item->ORD_PAYMENT_RECEIPT))?asset('uPackage.png'):asset($item->ORD_PAYMENT_RECEIPT)}}" data-lightbox="gallery-group-1">
                                                    <img style="width: 50%;height: 100%;" src="{{($item->ORD_PAYMENT_RECEIPT==null||!file_exists($item->ORD_PAYMENT_RECEIPT))?asset('uPackage.png'):asset($item->ORD_PAYMENT_RECEIPT)}}">
                                                </a>
                                            </center>
                                           <br>
                                        </div>
                                        @foreach($order_item->where('ORD_ID',$item->ORD_ID) as $ord_item)
                                        <div class="col-md-8">
                                            <strong style="color:dimgray">Transaction Code: {{$ord_item->PROD_NAME}}</strong>{{$ord_item->ORD_SYMP_TRANS_CODE}}<br>
                                            <strong style="color:dimgray">Product Name: {{$ord_item->PROD_NAME}}</strong><br>
                                            <strong>Qty: {{$ord_item->ORDI_QTY}}</strong><br>
                                            <small>Price: {{Sympies::current_price(number_format($ord_item->ORDI_SOLD_PRICE,2))}}</small><br>
                                        </div>
                                        @endforeach
                                    </div>
                                    
                                </td>
                                <td>
                                    <strong>{{ $item->ORD_FROM_NAME}}</strong><br>
                                    <small>
                                        <span style="overflow: hidden; text-overflow: ellipsis;text-overflow: ellipsis; white-space: nowrap;">
                                            Contact No: {{$item->ORD_FROM_CONTACT}}
                                        </span><br>

                                        <span style="overflow: hidden; text-overflow: ellipsis;text-overflow: ellipsis; white-space: nowrap;">
                                            Email: <a target="_blank" href="mailto:{{ $item->ORD_FROM_EMAIL}}">{{ $item->ORD_FROM_EMAIL}}</a>
                                        </span>
                                    </small>
                                </td>
                                <td>

                                    <strong>{{ $item->ORD_TO_CONTACT}}</strong><br>
                                    <small>
                                        <span >
                                            Shipping Address: {{ $item->ORD_HOUSE_NO}} {{ $item->ORD_STREET}} {{ $item->ORD_BARANGAY}} {{ $item->ORD_CITY}}
                                        </span> <br>
                                        <span style="overflow: hidden; text-overflow: ellipsis;text-overflow: ellipsis; white-space: nowrap;">
                                            Contact No: {{$item->ORD_TO_CONTACT}}
                                        </span> <br>
                                        <span style="overflow: hidden; text-overflow: ellipsis;text-overflow: ellipsis; white-space: nowrap;">
                                            Email: <a target="_blank" href="mailto:{{$item->ORD_TO_EMAIL}}">{{$item->ORD_TO_EMAIL}}</a>
                                        </span>
                                    </small><br>
                                </td>
                                <td style="background: {{$color}}"><center>{{$status}}</center></td>
                                <td data-sort="{{$item->created_at}}">{{ (new DateTime($item->created_at))->format('D M d, Y | h:i A') }}</td>
                                <td>
                                    <center>
                                        <div class="btn-group">

                                            <a id=invoice  vals="{{$item->ORD_ID}}" class="btn btn-purple"  data-toggle="tooltip" title="View Invoice" href="{{url('/invoice/details/'.$item->ORD_ID)}}" target="_blank"><i class="fas fa-clipboard text-white"></i></a>
                                            @if($status!='For Delivery')
                                             <a id=approved  vals="{{$item->ORD_ID}}" class="btn btn-warning approved" data-toggle="tooltip" title="Approved Receipt" href="javascript:;"><i class="fas fa-thumbs-up text-white"></i></a>
                                             <a id=reject  vals="{{$item->ORD_ID}}" class="btn btn-danger reject" data-toggle="tooltip" title="Reject Receipt" href="javascript:;"><i class="fas fa-thumbs-down text-white"></i></a>
                                             @endif
                                                @if($status != 'Cancelled' && $status != 'Void' && $status != 'Refunded')
                                                    {{--<button type="button" class="btn btn-info btn-flat dropdown-toggle" data-toggle="dropdown" title="More Options" ></button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        @if($status=='Completed')
                                                            <li> <a btn=4 id=void  vals="{{$item->ORD_ID}}"  href="javascript:;">Mark as Void</a></li>
                                                        @endif
                                                        @if($status=='Pending' || $status=='Approval Of Receipt')
                                                            <li><a btn=5 id=shipped  vals="{{$item->ORD_ID}}"  href="javascript:;">Mark as Delivered</a></li>
                                                            <li><a btn=6 id=cancel  vals="{{$item->ORD_ID}}"  href="javascript:;"> Mark as Cancelled</a></li>
                                                        @endif

                                                        @if($status=='Request Refund')
                                                                <li><a btn=5 id=shipped  vals="{{$item->ORD_ID}}"  href="javascript:;">Mark as Delivered</a></li>
                                                            <li><a btn=3 id=refund  vals="{{$item->ORD_ID}}" href="javascript:;">Mark as Refunded</a>
                                                            <li><a btn=3.1 id=refundVoid  vals="{{$item->ORD_ID}}"  href="javascript:;">Cancel Request</a>
                                                        @endif
                                                        @if($status=='Request Cancellation')
                                                                <li><a btn=5 id=shipped  vals="{{$item->ORD_ID}}"  href="javascript:;">Mark as Delivered</a></li>
                                                            <li><a btn=6 id=cancel  vals="{{$item->ORD_ID}}"  href="javascript:;"> Mark as Cancelled</a></li>
                                                            <li><a btn=6.1 id=cancelVoid  vals="{{$item->ORD_ID}}"    href="javascript:;">Cancel Request</a></li>
                                                        @endif
                                                    </ul>--}}
                                                    @endif
                                        </div>





                                    </center>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <th style="width: 1%;" hidden>
                                <input type="checkbox" class="form-check-input" style="height: 20px;width: 20px;margin-top:20px;" disabled />
                            </th>
                            <th>Order Information</th>
                            <th >Sender Info</th>
                            <th >Receiver Info</th>
                            <th >Status</th>
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



@endsection

@section('extrajs')
    <script>
    $table =$('#data-table-buttons').DataTable({
            'responsive': true,
            "sPaginationType": "full_numbers",
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            "aaSorting": [[3, "desc" ]]
            
        });
        // rows = $table.rows({ 'search': 'applied' }).nodes();


        $('.approved').click(function(){
            order_id=$(this).attr("vals");
            data = {
                status:"For Delivery",
                order_id:order_id,
                _token: CSRF_TOKEN
            }
            evaluate(data);
            
            
        });
        $('.reject').click(function(){
            order_id=$(this).attr("vals");
            data = {
                status:"Receipt Declined",
                order_id:order_id,
                _token:CSRF_TOKEN
            }
            evaluate(data);
            
        });

        function evaluate(data) {
            swal({
                title: "Evaluate Order"
                , text: "After this action, this record will be updated"
                , type: "warning"
                , showLoaderOnConfirm: true
                , showCancelButton: true
                , confirmButtonColor: '#9DD656'
                , confirmButtonText: 'Yes'
                , cancelButtonText: "No"
                , closeOnConfirm: false
                , closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "{{asset('')}}/evaluate"
                        , method: 'post'
                        , data: data
                        , success: function () {
                            location.reload();
                        }
                        , error: function (e) {
                            swal("Error occured"+e, "Please try again", "error");
                        }
                    });
                }
            });
        }




        // orderIDs = [];
        // $('input[id=checkAll]').on('change',function(){
        //     if($('input[id=checkAll]').prop('checked'))
        //         $(rows).find('input[id=isChecked]').prop('checked',true);
        //     else
        //         $(rows).find('input[id=isChecked]').prop('checked',false);

        //     countChecked();
        // });

        // $(rows).find('input[id=isChecked]').on('change',function(){

        //     if($(rows).find('input[id=isChecked]:checked').length == $(rows).find('input[id=isChecked]').length)
        //         $('input[id=checkAll]',rows).prop('checked',true);
        //     else
        //         $('input[id=checkAll]',rows).prop('checked',false);

        //     countChecked();

        // });

        // function countChecked(){
        //     $('span[id=countChecked]').text($(rows).find('input[id=isChecked]:checked').length);
        //     if($(rows).find('input[id=isChecked]:checked').length==0){
        //         $('a[id=shippedSome]').prop('disabled',true);
        //         $('a[id=voidSome]').prop('disabled',true);
        //     }else{
        //         $('a[id=shippedSome]').prop('disabled',false);
        //         $('a[id=voidSome]').prop('disabled',false);
        //     }

        //     orderIDs = [];
        //     $.each($(rows).find('input[id=isChecked]:checked'),function(){
        //         orderIDs.push($(this).attr('vals'));

        //     })

        // }


        // $('a[btn]').on('click',function(){
        //    $btn = $(this).attr('btn');
        //    $id = $(this).attr('vals');
        //    $title = "";


        //     if($btn==1)
        //         $title = 'The selected item/s will be marked as DELIVERED!';
        //     else if($btn==2)
        //         $title = 'The selected item/s will be marked as VOID!';
        //     else if($btn==3)
        //         $title = 'This item will be marked as REFUNDED!';
        //     else if($btn==4)
        //         $title = 'This item will be marked as VOID!';
        //     else if($btn==5)
        //         $title = 'This item will be marked as DELIVERED!';
        //     else if($btn==6)
        //         $title = 'This item will be marked as CANCELLED!';
        //     else if($btn==6.1)
        //         $title = 'This item will cancel the CANCELLATION REQUEST!';
        //     else if($btn==3.1)
        //         $title = 'This item will cancel the REFUND REQUEST!';


        //     if($btn==1 ||$btn==2 ){
        //         if($(rows).find('input[id=isChecked]:checked').length){
        //             swal({
        //                 title: $title
        //                 , text: "After this action, this record will be updated"
        //                 , type: "warning"
        //                 , showLoaderOnConfirm: true
        //                 , showCancelButton: true
        //                 , confirmButtonColor: '#9DD656'
        //                 , confirmButtonText: 'Yes!'
        //                 , cancelButtonText: "No!"
        //                 , closeOnConfirm: false
        //                 , closeOnCancel: true
        //             }, function (isConfirm) {
        //                 if (isConfirm) {
        //                     $.ajax({
        //                         url: '/order'
        //                         , type: 'post'
        //                         , data: {id:$id, ids:orderIDs,type: $btn, _token: CSRF_TOKEN}
        //                         , success: function () {
        //                             location.reload();
        //                         }
        //                         , error: function (e) {
        //                             swal("Error occured"+e, "Please try again", "error");
        //                         }
        //                     });
        //                 }
        //             });
        //         }else{

        //             swal("Please select item/s", "Please try again", "error");
        //         }
        //     }else{
        //         swal({
        //             title: $title
        //             , text: "After this action, this record will be updated"
        //             , type: "warning"
        //             , showLoaderOnConfirm: true
        //             , showCancelButton: true
        //             , confirmButtonColor: '#9DD656'
        //             , confirmButtonText: 'Yes!'
        //             , cancelButtonText: "No!"
        //             , closeOnConfirm: false
        //             , closeOnCancel: true
        //         }, function (isConfirm) {
        //             if (isConfirm) {
        //                 $.ajax({
        //                     url: '/order'
        //                     , type: 'post'
        //                     , data: {id:$id, ids:orderIDs,type: $btn, _token: CSRF_TOKEN}
        //                     , success: function () {
        //                         location.reload();
        //                     }
        //                     , error: function (e) {
        //                         swal("Error occured"+e, "Please try again", "error");
        //                     }
        //                 });
        //             }
        //         });
        //     }





        // });

    </script>
@endsection
