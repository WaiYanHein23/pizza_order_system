@extends('admin.layouts.master')

@section('content')
@section('title','Category List Page')
  <!-- MAIN CONTENT-->
  <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Product List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{route('product#createPage')}}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="fa-thin fa-plus"></i>Add Pizza
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>
              @if(session('deleteSuccess'))
              <div class="col-4 offset-8">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                 <i class="fa-solid fa-circle-xmark"></i> {{session('deleteSuccess')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            </div>
              @endif
              <div class="row">
                <div class="col-3">
                    <h4 class="text-dark">Search Key: <span class="text-danger">{{request('key')}}</span></h4>
                </div>
              <div class="col-3 offset-6">
                <form action="{{route('product#list')}}" method="get">
                    @csrf
                  <div class="d-flex">
                      <input type="text" name="key" class="form-control" placeholder="Search" value="{{request('key')}}">
                    <button class="btn bg-dark text-white" type="submit">
                        <i class="fa-solid fa-magnifying-glass-plus"></i></button>
                  </div>
                </form>
              </div>
              </div>
              <div class="row my-2">
                <div class="col-1 offset-10 shadow-sm"><h3><i class="fa-duotone fa-database"></i>{{$pizzas->total()}}</h3></div>
            </div>
               @if(count($pizzas)!=0)
               <div class="table-responsive table-responsive-data2">
                <table class="table table-data2">
                    <thead>
                        <tr>
                            <th class="col-3">Image</th>
                            <th class="col-3">Name</th>
                            <th class="col-3">Price</th>
                            <th class="col-3">Category</th>
                            <th class="col-3">View Count</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($pizzas as $p)
                       <tr class="tr-shadow my-1">
                        <td><img src="{{asset('storage/'.$p->image)}}" class="img-thumbnail shadow-sm" ></td>
                        <td >{{$p->name}}</td>
                        <td>{{$p->price}}</td>
                        <td>{{$p->category_name}}</td>
                        <td><i class="fa-solid fa-face-viewfinder"></i>{{$p->view_count +1}}</td>
                        <td>
                            <div class="table-data-feature">
                          <div class="table-data-feature">
                              <a href="{{route('product#edit',$p->id)}}">
                                <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                    <i class="fa-sharp fa-solid fa-camera-viewfinder"></i>
                                </button>
                              </a>
                             <a href="{{route('product#updatePage',$p->id)}}">
                              <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                  <i class="zmdi zmdi-edit"></i>
                              </button>
                             </a>
                              <a href="{{route('product#delete',$p->id)}}">
                                  <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                      <i class="zmdi zmdi-delete"></i>
                                  </button>
                              </a>
                          </div>

                          </div>
                        </td>
                    </tr>

                       @endforeach


                    </tbody>
                </table>
                <div class="m-4">
                    {{$pizzas->links()}}
                </div>

            </div>
            @else
            <h4 class="text-danger text-center">There is no Pizza Here</h4>
               @endif


                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->

@endsection
