@extends('admin2.index')
@section('title','Thêm Banner Mới')
@section('url','/ banner / create')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h3>Thêm banner mới</h3>
          </div>
          <div class="card-body pb-0">
            <div class="table-responsive p-0">
                <form action="/admin/banner" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label  class="form-lable text-lg col-2 ">Tiêu đề:</label>
                      
                      <input type="text" name="name" id="" class="form-control @error('name') is-invalid @enderror" placeholder="Nhập tên nhà sản xuất..." value="{{old('name')}}">

                      @error('name')
                      <p class="text-danger mt-3 text-sm">{{ $message }}</p>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label class="form-lable text-lg col-2 ">Hình ảnh:</label>
                      <input type="file" name="file" id="imageFile"  onchange= "chooseFile(this)"  class="form-control col-4">
                      @error('file')
                      <p class="text-danger mt-3 text-sm">{{ $message }}</p>
                      @enderror
                      <img src="" alt="" srcset="" width="100" id="image" class="mt-3">
                    </div>
                    <div class="form-group d-flex">
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" name="show" checked>
                        <label class="form-check-label" for="flexSwitchCheckChecked">Hiển thị</label>
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <button class="btn btn-primary btn-sm">Thêm mới</button>
                      <a href="/admin/banner"class="btn btn-danger btn-sm">Trở về</a>
                    </form>
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
   $(document).ready(function(){
    $('.alert').delay(1000).hide(300);
                setTimeout(function() {
                $(".alert").remove();
                }, 2000);
   });

</script>
    
@endsection