@extends('home')
@section('title','Thông tin của bạn')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-3">
            <h3 class="text-center">Thông tin của bạn</h3>
            
            @if (session('success'))
                <div class="alert alert-success mt-3 ">{{session('success')}}</div>
            @endif
            <form action="/update-user" method="post" enctype="multipart/form-data">
                @csrf
                <div class="border p-3 ">
                    
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Tên đăng nhập:</label>
                        <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{Auth::user()->name}}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Email:</label>
                        <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{Auth::user()->email}}">
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="fullname" class="col-sm-2 col-form-label">Họ tên:</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control col-4" id="fullname" name="fullname" value="{{Auth::user()->fullname}}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="fullname" class="col-sm-2 col-form-label">Giới tính:</label>
                        <div class="col-sm-10">
                            <select name="gender" id="" class="form-control col-2" >
                                @if (Auth::user()->gender == 'Nam')
                                    <option value="{{Auth::user()->gender}}">{{Auth::user()->gender}}</option>
                                    <option value="Nữ">Nữ</option>
                                @else
                                    <option value="{{Auth::user()->gender}}">{{Auth::user()->gender}}</option>
                                    <option value="Nam">Nam</option>
                                @endif
                                </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="fullname" class="col-sm-2 col-form-label">Số điện thoại:</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control col-4" id="phone" name="phone" value="{{Auth::user()->phone}}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="fullname" class="col-sm-2 col-form-label">Địa chỉ:</label>
                        <div class="col-sm-10">
                        <textarea  class="form-control col-4" id="address" name="address"> {{Auth::user()->address}}</textarea>
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="fullname" class="col-sm-2 col-form-label">Ảnh đại diện:</label>
                        <div class="col-sm-10">
                            <img src="/assets/img/{{Auth::user()->image}}" alt="" srcset="" width="100">
                        <input type="file" class="form-control col-4" id="file" name="file">
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-success mt-3">Cập nhật thông tin</button>
                </div>
        </form> 
        </div>
</div>


@endsection