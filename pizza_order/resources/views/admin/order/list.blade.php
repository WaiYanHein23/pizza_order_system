@extends('admin.layouts.master')

@section('content')
@section('title','Category List Page')
  <!-- MAIN CONTENT-->
  <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
              @if(session('deleteSuccess'))
              <div class="col-4 offset-8">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                 <i class="fa-solid fa-circle-xmark"></i> {{session('deleteSuccess')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            </div>
              @endif
              <div class="row my-2">
                <div class="col-1 offset-10 shadow-sm"><h3><i class="fa-duotone fa-database"></i>  {{count($order)}}</h3></div>
            </div>
           <form action="{{route('admin#changeStatus')}}" method="get">
            @csrf
            <div class="d-flex">
                <label for="" class="mt-2 me-3">Order Status</label>
                <select name="orderStatus" class="form-control col-2">
                    <option value="">All</option>
                    <option value="1" @if(request('orderStatus')=='0')selected  @endif>Accept</option>
                    <option value="2" @if(request('orderStatus')=='1')selected  @endif>Reject</option>
                    <option value="0" @if(request('orderStatus')==2)selected  @endif>Pending</option>
                </select>
                <button type="submit" class="btn btn-sm ms-3 bg-dark text-white">Search</button>
            </div>
           </form>
               <div class="table-responsive table-responsive-data2">
                <table class="table table-data2">
                    <thead>
                        <tr>
                            <th>User Id</th>
                            <th>User Name</th>
                            <th>Order Date</th>
                            <th>Order Code</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="dataList">
                       @foreach($order as $o)
                       <tr class="tr-shadow my-1">
                            <input type="hidden" class="orderId" value="{{$o->id}}">
                           <td>{{$o->user_id}}</td>
                           <td>{{$o->user_name}}</td>
                           <td>{{$o->created_at->format('j-F-Y')}}</td>
                           <td><a href="{{route('admin#listInfo',$o->order_code)}}">{{$o->order_code}}</a></td>
                           <td>{{$o->total_price}}</td>
                           <td>
                            <select name="status" class="form-control  statusChange">
                                <option value="0" @if($o->status==0) selected  @endif>Pending</option>
                                <option value="1" @if($o->status==1) selected  @endif>Accept</option>
                                <option value="2" @if($o->status==2) selected  @endif>Reject</option>
                            </select>
                            </td>
                    </tr>

                       @endforeach


                    </tbody>
                </table>
            </div>

                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->

@endsection
 @section('scriptSection')
<script>
    $(document).ready(function(){
    //     $('#orderStatus').change(function(){
    //         $status=$('#orderStatus').val();
    //         $.ajax({
    // type : 'get' ,
    // url : 'http://127.0.0.1:8000/order/ajax/status',
    // data :{
    //     'status': $status,
    // },
    // dataType :'json',
    // success : function(response){

    //     $list='';
    //    for($i=0;$i<response.length;$i++){
    //     $months=['January','February','March','April','May','June','July','August','September','October','November','December'];
    //     $dbDate= new Date(response[$i].created_at);
    //     $finalDate=$months[$dbDate.getMonth()]+"-"+$dbDate.getDate()+"-"+$dbDate.getFullYear();
    //     if(response[$i].status==0){
    //        $statusMessage=` <select name="status" class="form-control  statusChange">
    //                             <option value="0" selected>Pending</option>
    //                             <option value="1">Accept</option>
    //                             <option value="2">Reject</option>
    //                         </select>
    //                         `;
    //     }else if(response[$i].status==1){
    //         $statusMessage=` <select name="status" class="form-control  statusChange">
    //                             <option value="0">Pending</option>
    //                             <option value="1" selected>Accept</option>
    //                             <option value="2">Reject</option>
    //                         </select>
    //                         `;

    //     }else if(response[$i].status==2){
    //         $statusMessage=` <select name="status" class="form-control  statusChange">
    //                             <option value="0">Pending</option>
    //                             <option value="1">Accept</option>
    //                             <option value="2" selected>Reject</option>
    //                         </select>
    //                         `;
    //                     }
    //     $list +=`
    //     <tr class="tr-shadow my-1">
    //                      <input type="hidden" class="orderId" value="${response[$i].id}">
    //                        <td>${response[$i].user_id}</td>
    //                        <td>${response[$i].user_name}</td>
    //                        <td>${ $finalDate}</td>
    //                        <td>${response[$i].order_code}</td>
    //                        <td>${response[$i].total_price}</td>
    //                        <td>${$statusMessage}</td>
    //                 </tr>

    //     `;
    //    }
    //     $('#dataList').html($list);
    // }

    //           })
    //     })
        //change status
        $('.statusChange').change(function(){
    $currentStatus=$(this).val();
    $parentNode=$(this).parents("tr");
    $orderId=$parentNode.find('.orderId').val();
    $data={
        'status':$currentStatus,
        'orderId':$orderId
    };
    $.ajax({
    type : 'get' ,
    url : 'http://127.0.0.1:8000/order/ajax/change/status',
    data :$data,
    dataType :'json',
})
        })
    })


</script>
 @endsection
