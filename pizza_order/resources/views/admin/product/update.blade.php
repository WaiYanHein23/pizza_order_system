@extends('admin.layouts.master')

@section('content')
@section('title','Category List Page')
  <!-- MAIN CONTENT-->
  <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
                        <div class="card-title">
                            <h3 class="text-center title-2">Update Pizza</h3>
                        </div>
                        <hr>
                    <form action="{{route('product#update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row offset-1 mt-5">
                            <input type="hidden" name="pizzaId" value="{{$pizza->id}}">
                            <div class="col-4 ">
                             <img src="{{asset('storage/'.$pizza->image)}}" style="width: 300px" class="shadow-sm w-50" />
                             <div class="mt-3">
                                <input type="file" name="pizzaImage" class="form-control @error('pizzaImage') is-invalid @enderror" id="">
                                @error('pizzaImage')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>

                                @enderror
                             </div>
                             <div class="mt-3">
                               <button type="submit" class="btn bg-dark text-white"><i class="fa-solid fa-arrow-rotate-right"></i> Update</button>
                             </div>
                            </div>
                            <div class="row col-6">
                                <div class="form-group">
                                    <label class="control-label mb-1">Name</label>
                                    <input id="cc-pament" name="pizzaName" type="text" value="{{old('pizzaName',$pizza->name)}}"  class="form-control @error('pizzaName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin pizzaName">
                                    @error('pizzaName')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>

                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Description</label>

                                  <textarea name="pizzaDescription" class="form-control  @error('pizzaDescription') is-invalid @enderror" cols="30" rows="10" placeholder="Enter Description">{{old('pizzaDescription',$pizza->description)}}</textarea>
                                    @error('pizzaDescription')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>

                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Category</label>
                                   <select name="pizzaCategory" class="form-control @error('pizzaCategory') is-invalid @enderror">
                                    <option value="">Choose Category</option>
                                    @foreach ($category as $c)
                                    <option value="{{$c->id}}"@if($pizza->category_id==$c->id) selected @endif>{{$c->name}}</option>


                                    @endforeach
                                   </select>
                                   @error('pizzaCategory')
                                   <div class="invalid-feedback">
                                       {{$message}}
                                   </div>

                                   @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Price</label>
                                    <input id="cc-pament" name="pizzaPrice" type="number" value="{{old('pizzaPrice',$pizza->price)}}"  class="form-control @error('pizzaPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Pizza Price">
                                    @error('pizzaPrice')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>

                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Waiting Time</label>
                                    <input id="cc-pament" name="pizzaWaitingTime" type="number" value="{{old('pizzaWaitingTime',$pizza->waiting_time)}}"  class="form-control @error('pizzaWaitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Waiting Time">
                                    @error('pizzaWaitingTime')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>

                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">View Count</label>
                                    <input id="cc-pament" name="viewCount" type="text" value="{{old('viewCount',$pizza->view_count)}}"  class="form-control" disabled aria-required="true" aria-invalid="false">
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Created Date</label>
                                    <input id="cc-pament" name="created_at" type="text" value="{{$pizza->created_at->format('j-F-Y')}}" class="form-control @error('role') is-invalid @enderror" aria-required="true" aria-invalid="false" disabled>

                                </div>

                               </div>
                           </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->

@endsection
