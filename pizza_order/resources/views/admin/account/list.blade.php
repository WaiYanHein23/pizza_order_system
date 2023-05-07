@extends('admin.layouts.master')

@section('content')
@section('title','Category List Page')
  <!-- MAIN CONTENT-->
  <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
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
                <form action="{{route('admin#list')}}" method="get">
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
                <div class="col-1 offset-10 shadow-sm">
                    <h3><i class="fa-duotone fa-database"></i>{{$admin->total()}} </h3></div>
            </div>
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="tr-shadow my-1">
                              @foreach ($admin as $a)
                              <td class="col-1">
                                @if ($a->image==null)
                                   @if ($a->gender=='male')
                                   <img src="{{asset('image/default_user.png')}}" class="img-thumbnail shadow-sm" >

                                   @else
                                   <img src="{{asset('image/female_user.png')}}" class="img-thumbnail shadow-sm" >

                                   @endif

                                @else

                                    <img src="{{asset('storage/'.$a->image)}}" class="img-thumbnail shadow-sm" >


                                @endif
                              </td>
                                <td>{{$a->name}}</td>
                                <td>{{$a->email}}</td>
                                <td>{{$a->gender}}</td>
                                <td>{{$a->phone}}</td>
                                <td>{{$a->address}}</td>
                                <td>
                                    @if (Auth::user()->id==$a->id)

                                    @else
                                    <a href="{{route('admin#changeRole',$a->id)}}">
                                        <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Chamge Admin Role">
                                            <i class="fa-solid fa-person-circle-minus"></i>
                                        </button>
                                    </a>
                                    <a href="{{route('admin#delete',$a->id)}}">
                                        <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                    </a>

                                    @endif
                                </td>
                          </tr>
                              @endforeach

                        </tbody>
                    </table>
                    <div class="m-4">
                        {{$admin->links()}}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->

@endsection
