@extends('admin2.index')
@section('title','Thêm Danh Mục')
@section('url','/ danh-muc/create')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h3>Thêm danh mục sản phẩm</h3>
          </div>
          <div class="card-body pb-0">
            <div class="table-responsive p-0">
                <form action="/admin/danh-muc" method="post">
                    @csrf
                    <div class="form-group">
                      <label  class="form-lable text-lg ">Danh mục:</label>
                      <input type="text" name="name" placeholder="Nhập tên danh mục sản phẩm..." class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
                      @error('name')
                      <p class="text-danger mt-3 text-sm">{{ $message }}</p>
                      @enderror
                    </div>
                    <div class="form-group">
                      <button class="btn btn-primary btn-sm">Thêm mới</button>
                    </div>
                </form>
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