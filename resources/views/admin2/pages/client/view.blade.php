@extends('admin2.index')
@section('title','Thông tin khách hàng')
@section('url','/ khach-hang / '.$client->name.'')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
          </div>
        
          <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
            <div class="row gx-4">
              <div class="col-auto ">
                <div class="avatar avatar-xl position-relative ">
                  <img src="/assets/img/{{$client->image}}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                </div>
              </div>
              <div class="col-auto my-auto">
                <div class="h-100">
                  <h5 class="mb-1">
                    {{$client->fullname}}
                  </h5>
                  <p class="mb-0 font-weight-bold text-sm">
                    {{$client->name}}
                  </p>
                </div>
              </div>
              
            </div>
          </div>

          <div class="container-fluid py-4">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card-body">
                        <h3 class="text-uppercase h3 text-center">Thông tin tài khoản</h3>
                        <div class="row mt-5">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Tên đăng nhập:</label>
                                    <span>  {{$client->name}}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Địa chỉ email:</label>
                                    <span> {{$client->email}}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Điện thoại:</label>
                                    <span> {{$client->phone}}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Họ tên:</label>
                                    <span> {{$client->fullname}}</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Ngày sinh:</label>
                                    <span> 
                                      <?php
                                       $date=date_create($client->birthday);
                                        echo date_format($date,"d/m/Y");
                                      ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Giới tính:</label>
                                    <span> {{$client->gender}}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Địa chỉ:</label>
                                    <span> {{$client->address}}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Ảnh đại diện</label>
                                </div>
                                <img src="assets/img/{{$client->image}}" alt="" width="160" id="image">
                            </div>
                    </div>
                        
                </div>
               
              </div>
          </div>
        </div>
      </div>
    </div>
    @if(session('thongbao'))
      <div class="success" style="position: fixed;right: 0;top: 0;"> 
        <div class="alert alert-success mt-3">{{session('thongbao')}}</div>
      </div>
    @endif
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script>
   $(document).ready(function()
   {
      $('.alert').delay(1000).hide(300);
        setTimeout(function() 
        {
          $(".alert").remove();
        }, 
      2000);

      $('.garde').click(function()
      {
        window.location.href = "/admin/quan-ly-don-hang/don-huy";
      });

      $('.delivered').click(function()
      {
        window.location.href = "/admin/quan-ly-don-hang/da-giao";
      });
    });
</script>
@endsection