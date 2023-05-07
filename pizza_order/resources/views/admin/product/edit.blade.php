@extends('admin.layouts.master')

@section('content')
@section('title','Category List Page')
  <!-- MAIN CONTENT-->
  <div class="main-content">
    <div class="row">
        <div class="col-3 offset-7 mb-2">
            @if(session('updateSuccess'))
            <div class="">
              <div class="alert alert-success alert-dismissible fade show" role="alert">
               <i class="fa-solid fa-circle-xmark"></i> {{session('updateSuccess')}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
          </div>
            @endif
        </div>
    </div>
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
                        <div class="card-title">
                            {{-- <h3 class="text-center title-2">Pizza Details</h3> --}}
                        </div>
                        <hr>
                      <div class="row">
                        <div class="col-3 offset-2">
                            <img src="{{asset('storage/'.$pizza->image)}}" class="img-thumbnail shadow-sm" />

                        </div>
                        <div class="col-7">
                            <h3 class="my-3 btn bg-danger w-50 text-white d-block"><i class="fa-solid fs-5 fa-calendar-day me-2"></i>{{$pizza->name}}</h3 >
                            <span class="my-3 btn bg-dark text-white"><i class="fa-solid fs-5 fa-money-bill-1 me-2"></i>{{$pizza->price}}kyats</span >
                            <span class="my-3 btn bg-dark text-white"><i class="fa-solid fs-5 fa-solid fa-clock me-2"></i>{{$pizza->waiting_time}}mins</span >
                            <span class="my-3 btn bg-dark text-white"><i class="fa-solid fs-5 fa-eye me-2"></i>{{$pizza->view_count}}</span >
                            <span class="my-3 btn bg-dark text-white"><i class="fa-solid fs-5 fa-coins me-2"></i>{{$pizza->category_name}}</span >
                            <div><i class="fa-solid fa-file-lines me-2"></i>Details</div><br>
                            <div>{{$pizza->description}}</div>

                            <div><i class="fa-solid fa-user-clock me-2"></i>{{$pizza->created_at->format('j-F-Y')}}</div>

                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->

@endsection
