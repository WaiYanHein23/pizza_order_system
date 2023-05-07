
@extends('user/layouts.master')
@section('content')

<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Profile</h3>
                        </div>
                        <hr>
                    <form action="{{route('user#accountChange',Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row offset-1 mt-5">
                            <div class="col-4 ">
                             @if (Auth::user()->image==null)
                             <img src="{{asset('image/default_user.png')}}" style="width: 300px" class="img-thumbnail shawdow-sm" />
                             @else
                             <img src="{{asset('storage/'.Auth::user()->image)}}" class="img-thumbnail shawdow-sm" />
                             @endif
                             <div class="mt-3">
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="">
                                @error('image')
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
                                    <input id="cc-pament" name="name" type="text" value="{{old('name',Auth::user()->name)}}"  class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Name">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>

                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Email</label>

                                 <input id="cc-pament" name="email" type="email" value="{{old('email',Auth::user()->email)}}" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin Email">
                                 @error('email')
                                 <div class="invalid-feedback">
                                     {{$message}}
                                 </div>

                                 @enderror
                                   </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Phone</label>
                                    <input id="cc-pament" name="phone" type="number" value="{{old('phone',Auth::user()->phone)}}" class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Admin PH Number">
                                    @error('phone')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>

                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Gender</label>
                                   <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                    <option value="">Choose Gender</option>
                                    <option value="male" @if(Auth::user()->gender=='male') selected @endif>Male</option>
                                    <option value="female"@if(Auth::user()->gender=='female') selected @endif>Female</option>
                                   </select>
                                   @error('gender')
                                   <div class="invalid-feedback">
                                       {{$message}}
                                   </div>

                                   @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Address</label>
                                    <textarea name="address" class="form-control  @error('address') is-invalid @enderror" cols="30" rows="10" placeholder="Enter Admin Address">{{old('address',Auth::user()->address)}}</textarea>
                                    @error('address')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>

                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Role</label>
                                    <input id="cc-pament" name="role" type="text" value="{{old('role',Auth::user()->role)}}" class="form-control @error('role') is-invalid @enderror" aria-required="true" aria-invalid="false" disabled>

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
