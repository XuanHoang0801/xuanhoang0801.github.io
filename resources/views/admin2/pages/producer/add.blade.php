@extends('admin2.index')
@section('title','Thêm Nhà Sản Xuất')
@section('url','/ nha-san-xuat/create')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h3>Thêm nhà sản xuất</h3>
          </div>
          <div class="card-body pb-0">
            <div class="table-responsive p-0">
                <form action="/admin/nha-san-xuat" method="post">
                    @csrf
                    <div class="form-group d-flex">
                      <label  class="form-lable text-lg col-2 ">Danh mục:</label>
                      <select name="categories" id="" class="form-select">
                        @foreach ($categories as $item)   
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group d-flex">
                      <label class="form-lable text-lg col-2 ">Nhà sản xuất:</label>
                      <input type="text" name="name" id="" class="form-control @error('name') is-invalid @enderror"" placeholder="Nhập tên nhà sản xuất..." value="{{old('name')}}">
                    </div>
                    @error('name')
                      <p class="text-danger mt-3 text-sm">{{ $message }}</p>
                      @enderror
                    <div class="form-group">
                      <button class="btn btn-primary btn-sm">Thêm mới</button>
                      <a href="/admin/nha-san-xuat"class="btn btn-danger btn-sm">Trở về</a>
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