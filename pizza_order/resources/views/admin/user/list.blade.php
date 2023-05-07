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
                <div class="col-1 offset-10 shadow-sm"><h3><i class="fa-duotone fa-database"></i>  </h3></div>
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
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody id="dataList">
                       @foreach ($users as $user)
                       <tr>
                        <td class="col-1">
                            @if ($user->image==null)
                            <img src="{{asset('image/default_user.png')}}" class="img-thumbnail shadow-sm" />
                            @else
                            <img src="{{asset('storage/'.$user->image)}}" />
                            @endif
                        </td>
                        <input type="hidden" id="userId" value="{{$user->id}}">
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->gender}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->address}}</td>
                        <td>
                            <select class="form-control statusChange">
                                <option value="user" @if($user->role=='user')selected @endif>User</option>
                                <option value="admin" @if($user->role=='admin')selected @endif>Admin</option>
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
        //change status
        $('.statusChange').change(function(){
    $currentStatus=$(this).val();
    $parentNode=$(this).parents("tr");
    $userId=$parentNode.find('#userId').val();
    $data={
        'userId':$userId,'role':$currentStatus
    };
    $.ajax({
    type : 'get' ,
    url : '/user/change/role',
    data :$data,
    dataType :'json',
})
location.reload();
        })

    })


</script>
 @endsection
