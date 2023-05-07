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
                <div class="col-1 offset-10 shadow-sm"><h3><i class="fa-duotone fa-database"></i> </h3></div>
            </div>

               <div class="table-responsive table-responsive-data2">
                <a href="{{route('admin#orderList')}}"><i class="fa-solid fa-angles-left"></i>Back</a>
                <table class="table table-data2">
                    <thead>
                        <tr>
                            <th>User Id</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Order Date</th>
                            <th>Qty</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody id="dataList">

                        @foreach($orderList as $o)
                        <tr class="tr-shadow my-1">
                            <td>{{$o->user_id}}</td>
                            <td><img src="{{asset('storage/'.$o->product_image)}}" class="img-thumbnails" ></td>
                            <td>{{$o->product_name}}</td>
                            <td>{{$o->created_at->format('j-F-Y')}}</td>
                            <td>{{$o->qty}}</td>
                            <td>{{$o->total}}</td>
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
